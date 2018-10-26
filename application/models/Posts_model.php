<?php

defined('BASEPATH') or exit('No direct script access allowed');

  class Posts_model extends CI_Model
  {
      public function view_all_post()
      {
          $result = $this->db->get('rs_post_table');

          return $result->result();
      }

      public function create_post($img_path)
      {
          // Input post data content to rs_post_table specifically thai language
        $data_post_table = array(
        'post_title'       => $this->db->escape_str($this->input->post('post_title')),
        'post_content'     => $this->db->escape_str($this->input->post('post_content')),
        'post_tag'         => $this->db->escape_str($this->input->post('post_tag')),
        'post_date'        => $this->input->post('post_date'),
        'user_id_post'     => $this->session->userdata('user_id'),
        'post_feature_img' => $img_path
        );

            $insert_post_table = $this->db->insert('rs_post_table', $data_post_table);
            $last_insert_id = $this->db->insert_id(); // last_primary_key  of  post_id

        /* english */
        $data_post_language_en = array(
        'post_title' => ($this->input->post('post_title_en')) != " " ?
         $this->db->escape_str($this->input->post('post_title_en')) : 
         $this->db->escape_str($this->input->post('post_title')),

        'post_content' => ($this->input->post('post_content_en')) != " " ?
         $this->db->escape_str($this->input->post('post_content_en')) : $this->db->escape_str($this->input->post('post_content')),

        'post_tag' => ($this->input->post('post_tag_en')) != " " ?
         $this->db->escape_str($this->input->post('post_tag_en')) : $this->db->escape_str($this->input->post('post_tag')),
        );
            foreach ($data_post_language_en as $key => $data_en) {
                $data = array(
            'lang_content' => $data_en,
            'lang_type' => $key,
            'lang_key' => 'EN',
            'lang_id_refer' => $last_insert_id,
          );
                $insert_post_table = $this->db->insert('rs_multilang_table', $data);
        }
        /* china */
        $data_post_language_cn = array(
        'post_title' =>  ($this->input->post('post_title_cn')) != " " ? $this->db->escape_str($this->input->post('post_title_cn')) : $this->db->escape_str($this->input->post('post_title')),
        'post_content' => ($this->input->post('post_content_cn')) != " " ? $this->db->escape_str($this->input->post('post_content_cn')) : $this->db->escape_str($this->input->post('post_content')),
        'post_tag' => ($this->input->post('post_tag_cn')) != " " ? $this->db->escape_str($this->input->post('post_tag_cn')) : $this->db->escape_str($this->input->post('post_tag')),
        );
            foreach ($data_post_language_cn as $key => $data_cn) {
              $data = array(
                  'lang_content' => $data_cn,
                  'lang_type' => $key,
                  'lang_key' => 'CN',
                  'lang_id_refer' => $last_insert_id,
                );
              $insert_post_table = $this->db->insert('rs_multilang_table', $data);
          }

            if ($this->db->last_query()) {
                return true;
            } else {
                return false;
            }
      } // end function create_post


      public function delete_post($post_id){
        $this->db->where('post_id', $post_id);
        $result_data = $this->db->get('rs_post_table');
        $post_data = $result_data->row();

        if(!empty($post_data->post_feature_img)){
            $delete_img_path = './upload_images/'.$post_data->post_feature_img;
            unlink($delete_img_path);
        }


        foreach ($post_data as $key => $post) {
            $this->db->where( array(
                'lang_id_refer' => $post_id,
                'lang_type'     => $key
            ));
            $delete_lang_table = $this->db->delete('rs_multilang_table');
        }

        $this->db->where('post_id' , $post_id);
        $delete_post_table = $this->db->delete('rs_post_table');

        if ($this->db->last_query() ) {
            return TRUE;
        } else {
            return FALSE;
        }


      }

      public function edit_post($post_id ,$img_path){

            $the_img_path = "";
            $this->db->where('post_id' , $post_id);
            $result = $this->db->get('rs_post_table');
            $get_img_path = $result->row();

            if(empty($get_img_path->post_feature_img) || $get_img_path->post_feature_img == " " ){
                
                if($img_path == " " || empty($img_path)){

                    $img_path = " ";
                }else{
                    $the_img_path = $img_path;
                }
            }else{

                if($img_path == " " || empty($img_path)){

                    $the_img_path = $get_img_path->post_feature_img;
                }else{

                    if($img_path != $get_img_path->post_feature_img){
                        $delete_img_path = './upload_images/'.$get_img_path->post_feature_img;
                        unlink($delete_img_path);
                        $the_img_path = $img_path;
                    }

                }

            }
          function editorfix($value)
          {
              // sometimes FCKeditor wants to add \r\n, so replace it with a space
              //sometimes FCKeditor wants to add <p>&nbsp;</p>, so replace it with nothing
              $order   = array("\\r\\n", "\\n", "\\r", "<p>&nbsp;</p>");
              $replace = array(" ", " ", " ", "");
              $value = str_replace($order, $replace, $value);
              return $value;
          }

            $data_post_table = array(
              'post_title'       => $this->db->escape_str($this->input->post('post_title', TRUE)),
              'post_content'     => editorfix($this->db->escape_str($this->input->post('post_content' , TRUE))),
              'post_tag'         => $this->db->escape_str($this->input->post('post_tag' , TRUE)),
              'post_date'        => $this->input->post('post_date'),
              'post_feature_img' => $the_img_path
            );
        
            $this->db->set($data_post_table);
            $this->db->where('post_id' , $post_id);
            $update_post_table = $this->db->update('rs_post_table');


             /* english */
            $data_post_language_en = array(
            'post_title' => ($this->input->post('post_title_en')) != " " ? editorfix($this->db->escape_str($this->input->post('post_title_en' ,TRUE))) : $this->db->escape_str($this->input->post('post_title',TRUE)),
            'post_content' => ($this->input->post('post_content_en')) != " " ? editorfix($this->input->post('post_content_en' ,TRUE)) : $data_post_table["post_content"],
            'post_tag' =>  ($this->input->post('post_tag_en')) != " " ? $this->db->escape_str($this->input->post('post_tag_en' , TRUE)) : $this->db->escape_str($this->input->post('post_tag',TRUE)),
            );

           foreach ($data_post_language_en as $key => $data_en) {
              $data = array(
                  'lang_content' => $data_en,
                  'lang_id_refer' => $post_id,
                );
              $this->db->set($data);
              $this->db->where(  "(lang_id_refer = '".$post_id."' AND  lang_key = 'EN' AND  lang_type = '".$key."' )", NULL, FALSE);
              $update_post_table = $this->db->update('rs_multilang_table');
            }


             /* china */
            $data_post_language_cn = array(
                'post_title' =>  ($this->input->post('post_title_cn')) != " " ? editorfix($this->db->escape_str($this->input->post('post_title_cn',TRUE))) : $this->db->escape_str($this->input->post('post_title',TRUE)),
                'post_content' => ($this->input->post('post_content_cn')) != " " ? editorfix($this->db->escape_str($this->input->post('post_content_cn',TRUE))) : $data_post_table["post_content"],
                'post_tag' => ($this->input->post('post_tag_cn')) != " " ?  $this->db->escape_str($this->input->post('post_tag_cn',TRUE)) : $this->db->escape_str($this->input->post('post_tag',TRUE)),
            );

             foreach ($data_post_language_cn as $key => $data_cn) {
                $data = array(
                    'lang_content' => $data_cn,
                    'lang_id_refer' => $post_id,
                  );
                $this->db->set($data);
                $this->db->where(  "(lang_id_refer = '".$post_id."' AND  lang_key = 'CN' AND  lang_type = '".$key."' )", NULL, FALSE);
                $update_post_table = $this->db->update('rs_multilang_table');
              }


              if ($this->db->last_query()) {
                    return TRUE;
                } else {
                    return FALSE;
                }

      } // end edit_post function



      public function post_by_id($post_id){

          $post_by_id = $this->db->query("SELECT *
            FROM rs_post_table
            JOIN rs_multilang_table
            ON rs_post_table.post_id= rs_multilang_table.lang_id_refer
            WHERE post_id = $post_id
          ");
          return  $post_by_id->result();
      }





  }//end model
