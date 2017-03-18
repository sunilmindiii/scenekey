<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Webservices extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        date_default_timezone_set('America/Los_Angeles');
    }

    public function index() {
        
    }

    public function addEventLike() {
        $user_id = $this->input->post('user_id');
        $event_id = $this->input->post('event_id');
        if ($user_id && $event_id) {

            $Check_like = $this->common_model->get_sql_select_data('tbl_like', array('event_id' => $event_id, 'user_id' => $user_id));
            $event_like_count = $this->common_model->get_sql_select_data('tbl_events', array('event_id' => $event_id), array('like_count'));

            if (!$Check_like) {

                if ($this->common_model->INSERTDATA('tbl_like', array('event_id' => $event_id, 'user_id' => $user_id, 'like_date' => date('Y-m-d h:i:s'), 'like_status' => 1))) {

                    $like_count = $event_like_count[0]['like_count'] + 1;
                    $this->common_model->UPDATEDATA('tbl_events', array('event_id' => $event_id), array('like_count' => $like_count));

                    $output['success'] = 1;
                    $output['msg'] = "your have liked the event.";
                } else {
                    $output['success'] = 0;
                    $output['msg'] = "Try Again";
                }
            } else {

                $like_status = $Check_like[0]['like_status'];
                $status = 1;
                $msg = "your have liked the event.";
                $like_count = $event_like_count[0]['like_count'] + 1;

                if ($like_status == 1) {
                    $status = 2;
                    $msg = "your have unliked the event.";
                    $like_count = $event_like_count[0]['like_count'] - 1;
                }
                if ($this->common_model->UPDATEDATA('tbl_like', array('event_id' => $event_id, 'user_id' => $user_id), array('like_date' => date('Y-m-d h:i:s'), 'like_status' => $status))) {


                    $this->common_model->UPDATEDATA('tbl_events', array('event_id' => $event_id), array('like_count' => $like_count));
                    $output['success'] = 1;
                    $output['msg'] = $msg;
                    ;
                } else {
                    $output['success'] = 0;
                    $output['msg'] = "Try Again";
                }
            }
        } else {
            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
        }
        echo json_encode($output);
    }

    public function listofuserattendedevent() {
        $event_date = array('1A' => '01:00:00', '2A' => '02:00:00', '3A' => '03:00:00', '4A' => '04:00:00', '5A' => '05:00:00',
            '6A' => '06:00:00', '7A' => '07:00:00', '8A' => '08:00:00', '9A' => '09:00:00', '10A' => '10:00:00',
            '11A' => '11:00:00', '12A' => '12:00:00', '1P' => '13:00:00', '2P' => '14:00:00', '3P' => '15:00:00',
            '4P' => '16:00:00', '5P' => '17:00:00', '6P' => '18:00:00', '7P' => '19:00:00', '8P' => '20:00:00',
            '9P' => '21:00:00', '10P' => '22:00:00', '11P' => '23:00:00', '12P' => '00:00:00');
        $output = array();
        $id = $this->input->post('user_id');
        $type = $this->input->post('type');
        $user_type = $this->input->post('user_type');

        if ($id == NULL || $type == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
            echo json_encode($output);
        } else if ($id != '') {
            $user_rating = 0;
            $rating_count = 0;
            /* =============== checking for artist ===================== */
            /* 	   if($type!='Venue' && $type!='User' && $type!='Promoter' ){
              if($user_type=='app'){
              $artist_id_rat=$this->common_model->getArtistIdByUserid($id);
              $artist_is_for_rating=$artist_id_rat[0]['artist_id'];
              if($artist_id_rat[0]['avg_rating']){
              $user_rating=$artist_id_rat[0]['avg_rating'];
              }
              }else{
              $artist_is_for_rating=$id;
              }
              $user_rating_count=$this->common_model->get_sql_select_data('tbl_rating',array('artist_id'=>$artist_is_for_rating),array('count(*) as count'));
              if($user_rating_count){
              $rating_count=$user_rating_count[0]['count'];
              }
              } */
            /* ============end here =================================== */
            /* =============== checking for Promoter ===================== */
            /* 	  else if($type=='Promoter'){
              $artist_rating=$this->common_model->getPromoterIdByUserid($id);
              if($artist_rating){
              $user_rating= $artist_rating[0]['avg_rating'];
              }
              } */
            /* ============end here =================================== */
            /* =============== checking for Social User ===================== */
            if ($type != 'Venue') {
                //$output['user_rating']=$user_rating;
                $output['user_rating_count'] = $rating_count;
                $where = array('userid' => $id);
                $order = 'id DESC';
                $userevent1 = $this->common_model->get_sql_select_data('tbl_userevent', $where, NULL, NULL, $order);
                $keyincount = count($userevent1);
                $k = 0;
                if ($userevent1) {
                    foreach ($userevent1 as $row_ev) {
                        $eventss[] = $row_ev['eventid'];

                        $order_by = 'id DESC';
                        $sql = $this->common_model->get_sql_select_data('tbl_event_feeds', array('event_id' => $row_ev['eventid'], 'user_id' => $id), null, null, $order_by);
                        if ($sql) {
                            $i = 0;
                            foreach ($sql as $row) {

                                $userimg = '';
                                $eventimage = '';
                                $uid = $row['user_id'];
                                $row1 = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $uid));
                                $username = !empty($row1[0]['userName']) ? $row1[0]['userName'] : '';
                                $userid = $uid;
                                $userFacebookId = !empty($row1[0]['userFacebookId']) ? $row1[0]['userFacebookId'] : '';
                                $event_id = !empty($row['event_id']) ? $row['event_id'] : '';
                                $ratetype = !empty($row['ratetype']) ? $row['ratetype'] : '';
                                $event_name = $row_ev['eventname'];
                                if (isset($row1[0]['userImage']) && $row1[0]['userImage']) {
                                    $userimg = base_url() . 'upload/' . $row1[0]['userImage'];
                                }

                                $userimage = $userimg;
                                $type = $row['type'];
                                $location = $row['location'];
                                $date = $row['date'];

                                if ($row['type'] == 'Comment') {
                                    $feed = $row['feed'];
                                } else if ($row['type'] == 'Rating') {
                                    if ($row['ratetype'] == 'Event') {
                                        $event_img = $this->common_model->get_sql_select_data('tbl_events', array('event_id' => $row['event_id']));
                                        if ($event_img[0]['event_pic']) {
                                            $eventimage = base_url() . 'upload/' . $event_img[0]['event_pic'];
                                        }
                                    }
                                    if ($row['ratetype'] == 'Artist') {
                                        $event_img = $this->common_model->get_sql_select_data('tbl_artist', array('artist_id' => $row['artist_id']));
                                        if ($event_img[0]['artist_image']) {
                                            $eventimage = base_url() . 'upload/' . $event_img[0]['artist_image'];
                                        }
                                    }
                                    $ratingimage = $eventimage;
                                    $feed = $row['feed'];
                                    $feeder_name = $row['hello'];
                                } else if ($row['type'] == 'Picture') {
                                    $newimage = $row['feed'];
                                    $path = "upload/" . $newimage;
                                    $feed = $path;
                                }
                                $i++;
                                $sqlarray = array('username' => $username,
                                    'userid' => $userid,
                                    'userFacebookId' => $userFacebookId,
                                    'event_id' => $event_id,
                                    'ratetype' => $ratetype,
                                    'event_name' => $event_name,
                                    'userimage' => $userimage,
                                    'type' => $type,
                                    'location' => $location,
                                    'date' => $date,
                                    'feed' => $feed
                                );
                                $output['events'][$event_name][] = $sqlarray;
                                $output['allfeeds'][] = $sqlarray;
                                $output['keyin_count'] = $keyincount;
                            }
                        }
                    }
                } else {
                    $output['success'] = 0;
                    $output['msg'] = "No Event Found yet";
                }
                echo json_encode($output);

                //$output['post_event']=$sqlarray; 

                /* 	if($eventss){
                  $implode=implode(',',$eventss);
                  $userevent2=$this->common_model->getuserevent($id,$implode);
                  $userevent=array_merge($userevent1,$userevent2);
                  }
                  else {
                  $userevent=	$userevent1;
                  } */
                /* 		if($userevent){
                  $i=0;
                  foreach($userevent as $row)
                  {
                  $rating=0;
                  $event_rating=$this->common_model->get_sql_select_data('tbl_events',array('event_id'=>$row['eventid']));
                  if($event_rating[0]['avg_rating']){
                  $rating=$event_rating[0]['avg_rating'];

                  }
                  $venue_add =$this->common_model->venueofevent($row['eventid']);

                  if($venue_add[0]['venue_address']=='' || $venue_add[0]['venue_address']==null){

                  $add=$venue_add[0]['venue_city'].', '.$venue_add[0]['venue_state'].', '.$venue_add[0]['venue_country'];
                  }
                  else {
                  $add=$venue_add[0]['venue_address'];

                  }

                  $sqlarray[$i]['eventid']=$row['eventid'];
                  $sqlarray[$i]['eventname']=$row['eventname'];
                  $sqlarray[$i]['venuename']=$venue_add[0]['venue_name'];

                  $sqlarray[$i]['address']=$add;
                  $venue_deatils =$this->common_model->get_sql_select_data('tbl_events',array('event_id'=>$row['eventid']));

                  if($venue_deatils[0]['event_type']==1){
                  $time=explode('T',$row['eventdate']);
                  if(isset($row['end_time'])){
                  $end=$row['end_time']*60;
                  }
                  else {
                  $end='240';

                  }
                  if(count($time)>2){
                  $sqlarray[$i]['eventdate']= $row['eventdate'];
                  }
                  else {
                  $sqlarray[$i]['eventdate'] = $row['eventdate'].'TO'.date('H:i:s', strtotime($time[1] . ' +'.$end.' minute'));
                  }
                  }
                  else {
                  $venue_id =$this->common_model->get_sql_select_data('tbl_venue',array('venue_id'=>$venue_deatils[0]['venue_id']));
                  $where_cat=array('category_id'=>$venue_id[0]['venue_category_id']);
                  $category =$this->common_model->get_sql_select_data('tbl_venue_category',$where_cat);
                  $attr=strtolower(date("l"));
                  $ev_date=explode('-',$category[0][$attr]);
                  $sqlarray[$i]['eventdate'] =$venue_deatils[0]['event_date'].'T'.$event_date[$ev_date[0]].'TO'.$event_date[$ev_date[1]];
                  }




                  $where_event=array('event_id'=>$row['eventid'],'type'=>'Picture');
                  $order_by='id DESC';
                  $userevent_img =$this->common_model->get_sql_select_data('tbl_event_feeds',$where_event,NULL,NULL,$order_by);
                  if($userevent_img){
                  $sqlarray[$i]['image']=base_url().'upload/'.$userevent_img[0]['feed'];
                  }
                  else{
                  $sqlarray[$i]['image']=base_url().'upload/defaultevent.jpg';

                  }
                  $sqlarray[$i]['rating']=$rating;
                  $i++;
                  }
                  $output['events']=$sqlarray;
                  echo json_encode($output);
                  }

                  else
                  {
                  $output['success'] = 0;
                  $output['msg'] = "No attended Event Found yet";
                  echo json_encode($output);

                  } */
            }
            /* ============end here =================================== */ else {
                $venue_rating = $this->common_model->get_sql_select_data('tbl_venue', array('venue_id' => $id));
                if ($venue_rating[0]['avg_rating_venue']) {
                    $user_rating = $venue_rating[0]['avg_rating_venue'];
                }
                $output['user_rating'] = $user_rating;

                $venue_rating_count = $this->common_model->venueAvgrating($id);
                if ($venue_rating_count) {
                    $rating_count = $venue_rating_count[0]['rating_count'];
                }
                $output['user_rating_count'] = $rating_count;

                $events = $this->common_model->get_sql_select_data('tbl_events', array('venue_id' => $id));
                if ($events) {
                    foreach ($events as $event) {
                        $rating = 0;
                        $venue_add = $this->common_model->venueofevent($event['event_id']);

                        if ($venue_add[0]['venue_address'] == '' || $venue_add[0]['venue_address'] == null) {

                            $add = $venue_add[0]['venue_city'] . ', ' . $venue_add[0]['venue_state'] . ', ' . $venue_add[0]['venue_country'];
                        } else {
                            $add = $venue_add[0]['venue_address'];
                        }


                        if ($event['event_type'] == 1) {
                            $time = explode('T', $event['event_date']);
                            if ($event['event_end_time']) {
                                $end = $event['event_end_time'] * 60;
                            } else {
                                $end = '240';
                            }
                            if (count($time) > 2) {
                                $eventdate = $event['event_date'];
                            } else {
                                $eventdate = $event['datetime'] . 'TO' . date('H:i:s', strtotime($time[1] . ' +' . $end . ' minute'));
                            }
                        } else {
                            $venue_id = $this->common_model->get_sql_select_data('tbl_venue', array('venue_id' => $event['venue_id']));
                            $where_cat = array('category_id' => $venue_id[0]['venue_category_id']);
                            $category = $this->common_model->get_sql_select_data('tbl_venue_category', $where_cat);
                            $attr = strtolower(date("l"));
                            $ev_date = explode('-', $category[0][$attr]);
                            $eventdate = $event['event_date'] . 'T' . $event_date[$ev_date[0]] . 'TO' . $event_date[$ev_date[1]];
                        }

                        $where_event = array('event_id' => $event['event_id'], 'type' => 'Picture');
                        $order_by = 'id DESC';
                        $userevent_img = $this->common_model->get_sql_select_data('tbl_event_feeds', $where_event, NULL, NULL, $order_by);
                        if ($userevent_img) {
                            $image = base_url() . 'upload/' . $userevent_img[0]['feed'];
                        } else {
                            $image = base_url() . 'upload/defaultevent.jpg';
                        }
                        if ($event['like_count']) {
                            $rating = $event['like_count'];
                        }
                        $sqlarray[] = array('eventid' => $event['event_id'], 'eventname' => $event['event_name'], 'venuename' => $venue_add[0]['venue_name'], 'address' => $add, 'eventdate' => $eventdate, 'image' => $image, 'rating' => $rating);
                    }
                    $output['events'] = $sqlarray;
                    echo json_encode($output);
                } else {
                    $output['success'] = 0;
                    $output['msg'] = "No attended Event Found yet";
                    echo json_encode($output);
                }
            }
        }
    }

    function checkeventstatus() {

        $output = array();
        $uid = $this->input->post('userid');
        $eid = $this->input->post('eventid');
        //Check that All Fields are not Empty

        if ($uid == NULL || $eid == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Check Parameter";
            echo json_encode($output);
        } else if ($uid != '' || $eid != '') {
            //$id=$data['eventid'];
            $sql = $this->common_model->get_sql_select_data('tbl_userevent', array('userid' => $uid, 'eventid' => $eid));
            if ($sql) {


                $output['success'] = 1;
                $output['status'] = "exist";
                echo json_encode($output);
            } else {

                $output['success'] = 0;
                $output['status'] = "not exist";
                echo json_encode($output);
            }
        }
    }

    function listofeventfeeds() {
        $event_date = array('1A' => '01:00:00', '2A' => '02:00:00', '3A' => '03:00:00', '4A' => '04:00:00', '5A' => '05:00:00',
            '6A' => '06:00:00', '7A' => '07:00:00', '8A' => '08:00:00', '9A' => '09:00:00', '10A' => '10:00:00',
            '11A' => '11:00:00', '12A' => '12:00:00', '1P' => '13:00:00', '2P' => '14:00:00', '3P' => '15:00:00',
            '4P' => '16:00:00', '5P' => '17:00:00', '6P' => '18:00:00', '7P' => '19:00:00', '8P' => '20:00:00',
            '9P' => '21:00:00', '10P' => '22:00:00', '11P' => '23:00:00', '12P' => '00:00:00');
        $sqlarrayt = '';
        $output = array();
        $id = $this->input->post('event_id');
        $userid = $this->input->post('user_id');

        if ($id == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
            echo json_encode($output);
        } else if ($id != '') {
            /////////////////////

            $order_by = 'id DESC';
            $sql = $this->common_model->get_sql_select_data('tbl_userevent', array('eventid' => $id), NULL, NULL, $order_by);
            if ($sql) {
                $i = 0;
                foreach ($sql as $row) {

                    $uid = $row['userid'];
                    $row1 = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $uid));
                    if ($row1) {
                        $sqlarrayt[$i]['username'] = !empty($row1[0]['userName']) ? $row1[0]['userName'] : '';
                        $sqlarrayt[$i]['userFacebookId'] = !empty($row1[0]['userFacebookId']) ? $row1[0]['userFacebookId'] : '';
                        $sqlarrayt[$i]['userid'] = !empty($row1[0]['userid']) ? $row1[0]['userid'] : '';
                        $sqlarrayt[$i]['user_status'] = $row1[0]['user_status'];

                        if ($row1[0]['usertype'] == 'Performers') {

                            $sqlarrayt[$i]['usertype'] = !empty($row1[0]['artisttype']) ? $row1[0]['artisttype'] : '';
                            $where_user = array('user_id' => $row1[0]['userFacebookId']);
                            $artist_rating = $this->common_model->get_sql_select_data('tbl_artist', $where_user);

                            if ($artist_rating[0]['avg_rating']) {
                                $sqlarrayt[$i]['rating'] = $artist_rating[0]['avg_rating'];
                            } else {
                                $sqlarrayt[$i]['rating'] = 0;
                            }
                        } else {

                            $sqlarrayt[$i]['usertype'] = !empty($row1[0]['usertype']) ? $row1[0]['usertype'] : '';
                            ;
                            $where_user = array('user_id' => $row1[0]['userFacebookId']);
                            $artist_rating = $this->common_model->get_sql_select_data('tbl_responser', $where_user);
                            if (isset($artist_rating[0]['avg_rating'])) {
                                $sqlarrayt[$i]['rating'] = $artist_rating[0]['avg_rating'];
                            } else {
                                $sqlarrayt[$i]['rating'] = 0;
                            }
                        }
                        $sqlarrayt[$i]['stagename'] = !empty($row1[0]['stagename']) ? $row1[0]['stagename'] : '';
                        //$sqlarray[$i]['userimage']=base_url().'upload/'.$row1['userImage'];
                        if (isset($row1[0]['userImage']) && $row1[0]['userImage']) {
                            $sqlarrayt[$i]['userimage'] = base_url() . 'upload/' . $row1[0]['userImage'];
                        } else {
                            $sqlarrayt[$i]['userimage'] = '';
                        }


                        $i++;
                    }
                }
                $output['eventattendy'] = $sqlarrayt;
            } else {
                $output['eventattendy'] = '';
            }

            ///////////////
            $num_count = $this->common_model->get_sql_select_data('tbl_nudges', array('event_id' => $id, 'user_to' => $userid, 'status' => 0));
            $output['nudges_count'] = count($num_count);
            $order_by = 'id DESC';
            $sql = $this->common_model->get_sql_select_data('tbl_event_feeds', array('event_id' => $id), null, null, $order_by);
            if ($sql) {
                $i = 0;
                foreach ($sql as $row) {
                    $userimg = '';
                    $eventimage = '';
                    $uid = $row['user_id'];
                    $row1 = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $uid));
                    $sqlarray[$i]['username'] = !empty($row1[0]['userName']) ? $row1[0]['userName'] : '';
                    $sqlarray[$i]['userid'] = $uid;
                    $sqlarray[$i]['userFacebookId'] = !empty($row1[0]['userFacebookId']) ? $row1[0]['userFacebookId'] : '';
                    $sqlarray[$i]['event_id'] = !empty($row['event_id']) ? $row['event_id'] : '';
                    $sqlarray[$i]['ratetype'] = !empty($row['ratetype']) ? $row['ratetype'] : '';
                    $sqlarrayt[$i]['user_status'] = @$row1[0]['user_status'];

                    if (isset($row1[0]['userImage'])) {
                        $userimg = base_url() . 'upload/' . $row1[0]['userImage'];
                    }

                    $sqlarray[$i]['userimage'] = $userimg;
                    $sqlarray[$i]['type'] = $row['type'];
                    $sqlarray[$i]['location'] = $row['location'];
                    $sqlarray[$i]['date'] = $row['date'];

                    if ($row['type'] == 'Comment') {
                        $sqlarray[$i]['feed'] = $row['feed'];
                    } else if ($row['type'] == 'Rating') {
                        if ($row['ratetype'] == 'Event') {
                            $event_img = $this->common_model->get_sql_select_data('tbl_events', array('event_id' => $row['event_id']));
                            if ($event_img[0]['event_pic']) {
                                $eventimage = base_url() . 'upload/' . $event_img[0]['event_pic'];
                            }
                        }
                        if ($row['ratetype'] == 'Artist') {
                            $event_img = $this->common_model->get_sql_select_data('tbl_artist', array('artist_id' => $row['artist_id']));
                            if ($event_img[0]['artist_image']) {
                                $eventimage = base_url() . 'upload/' . $event_img[0]['artist_image'];
                            }
                        }
                        $sqlarray[$i]['ratingimage'] = $eventimage;
                        $sqlarray[$i]['feed'] = $row['feed'];
                        $sqlarray[$i]['feeder_name'] = $row['hello'];
                    } else if ($row['type'] == 'Picture') {
                        $newimage = $row['feed'];
                        $path = "upload/" . $newimage;
                        $sqlarray[$i]['feed'] = $path;
                    }
                    $i++;
                }

                $output['allfeeds'] = $sqlarray;
            } else {
                $output['allfeeds'] = '';
            }

            /* 			$where=array('event_id'=>$id,'event_type'=>1);
              $realevent=$this->common_model->get_sql_select_data('tbl_events',$where);
              if($realevent) {
              $sqlquery=$this->common_model->geteventartist($id);

              if($sqlquery){
              foreach($sqlquery as $row)
              {
              $userid='';
              $artisttype='';

              $user_id=$this->common_model->get_sql_select_data('tbl_user',array('userFacebookId'=>$row['user_id']));
              if($user_id){
              $userid=$user_id[0]['userid'];
              }
              if(isset($user_id[0]['artisttype'])){
              $artisttype=$user_id[0]['artisttype'];
              }
              if($row['artist_image']){
              $userimg=base_url().'upload/'.$row['artist_image'];
              }
              else {
              $userimg=base_url().'img/defaultuser.png';

              }
              $output['artists'][]=array('name'=>$row['artist_name'],'id'=>$row['artist_id'],'user_id'=>$userid,'artist_type'=>$artisttype,'rating'=>$row['avg_rating'],'noofusers'=>$row['noofusers'],'type'=>'Artist','userimage'=>$userimg);

              }


              }
              } */
            //$venues=$this->common_model->geteventvenue($id);
            /* 		if($venues){
              foreach($venues as $row1)
              {
              if($row1['venue_image']){
              $venueimg=base_url().'/images/venue/'.$row1['venue_image'];
              }
              else {
              $venueimg=base_url().'img/defaultvenue.png';

              }
              $output['artists'][]=array('name'=>$row1['venue_name'],'id'=>$row1['venue_id'],'rating'=>$row1['avg_rating_venue'],'venue_lat'=>$row1['venue_lat'],'venue_long'=>$row1['venue_long'],'address'=>$row1['venue_address'],'venue_city'=>$row1['venue_city'],'venue_state'=>$row1['venue_state'],'userimage'=>$venueimg,'type'=>'Venue');
              }
              } */

            //$row6=$this->common_model->get_sql_select_data('tbl_events',array('event_id'=>$id));
            $row6 = $this->common_model->eventvenueData($id);
            $sqlarray = '';
			if($row6){
            if ($row6[0]['avg_rating']) {
                $sqlarray2[0]['event_rating'] = $row6[0]['avg_rating'];
            } else {
                $sqlarray2[0]['event_rating'] = 0;
            }
            if (isset($row6[0]['venue_location'])) {
                $location = $row6[0]['venue_location'];
            } else {
                $location = $row6[0]['venue_city'];
            }
            $sqlarray2[0]['venue_detail'] = $row6[0]['venue_name'] . ' ' . $location;
            $sqlarray2[0]['venue_id'] = $row6[0]['venue_id'];
            $sqlarray2[0]['venue_lat'] = $row6[0]['venue_lat'];
            $sqlarray2[0]['venue_long'] = $row6[0]['venue_long'];
            $sqlarray2[0]['description'] = @$row6[0]['description'];


            $sqlarray2[0]['event_name'] = $row6[0]['event_name'];
            /* 	if($row6[0]['category_id']==0){
              $sqlarray2[0]['category_id']=3;
              }
              else {
              $sqlarray2[0]['category_id']=$row6[0]['category_id'];

              }

              $category_event =$this->common_model->get_sql_select_data('tbl_event_category',array('id'=>$row6[0]['category_id']));

              if(isset($category_event[0]['name']) && $category_event[0]['name']!=null){
              $sqlarray2[0]['category_name']= $category_event[0]['name'];
              }
              else {
              $sqlarray2[0]['category_name']='Nightlife';
              } */

            if ($row6[0]['event_interval']) {
                $interval = $row6[0]['event_interval'] * 60;
                $event_interval = $row6[0]['event_interval'];
                $event_time = $row6[0]['datetime'] . 'TO' . date('H:i:s', strtotime($row6[0]['event_time'] . ' +' . $interval . ' minute'));
            } else {
                $event_time = $row6[0]['datetime'] . 'TO' . date('H:i:s', strtotime($row6[0]['event_time'] . ' +240 minute'));
                $event_interval = 4;
            }

            if ($row6[0]['event_type'] == 1) {
                $dtime = $event_time;
            } else {
                $venue_id = $this->common_model->get_sql_select_data('tbl_venue', array('venue_id' => $row6[0]['venue_id']));
                $where_cat = array('category_id' => $venue_id[0]['venue_category_id']);
                $category = $this->common_model->get_sql_select_data('tbl_venue_category', $where_cat);
                $attr = strtolower(date("l"));
                $ev_date = explode('-', $category[0][$attr]);
                $real_time = $row6[0]['event_date'] . 'T' . $event_date[$ev_date[0]] . 'TO' . $event_date[$ev_date[1]];
                $dtime = $real_time;
            }
		
            $sqlarray2[0]['interval'] = $event_interval;
            $sqlarray2[0]['event_date'] = $dtime;
			}
            $key_in = $this->common_model->get_sql_select_data('tbl_userevent', array('eventid' => $id, 'userid' => $userid));
            if ($key_in) {
                $sqlarray2[0]['key_in'] = 'exist';
            } else {
                $sqlarray2[0]['key_in'] = 'no exist';
            }
            $like = $this->common_model->get_sql_select_data('tbl_like', array('event_id' => $id, 'user_id' => $userid));
            if ($like && $like[0]['like_status'] == 1) {
                $sqlarray2[0]['like'] = 1;
            } else {
                $sqlarray2[0]['like'] = 0;
            }

            $output['event_profile_rating'] = $sqlarray2;
            echo json_encode($output);
        }
    }

    function addevent() {

        $output = array();
        $update_data = array();
        $uid = $this->input->post('userid');
        $eid = $this->input->post('eventid');
        $ename = $this->input->post('eventname');
        if ($uid == NULL || $eid == NULL || $ename == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Check Parameter";

            echo json_encode($output);
        } else if ($uid != '' || $eid != '') {

            $event = $this->common_model->get_sql_select_data('tbl_events', array('event_id' => $eid));
            $trending_point = 2;
            if ($event[0]['trending_point']) {
                $trending_point = $event[0]['trending_point'] + 2;
            }
            // $trending_point = $event[0]['trending_point'] + 2;
            $row5 = $this->common_model->get_sql_select_data('tbl_userevent', array('userid' => $uid, 'eventid' => $eid));
            if ($row5) {
                $output['success'] = 1;
                $output['status'] = "exist";
                echo json_encode($output);
            } else {
                $eventdate = $this->input->post('eventdate');

                $date = date('Y-m-d h:i:s');
                $this->common_model->INSERTDATA('tbl_userevent', array('eventdate' => $eventdate, 'userid' => $uid, 'eventid' => $eid, 'eventname' => $ename, 'date' => $date));
                $output['success'] = 0;
                $output['status'] = "event_Added";
                $this->apple($uid, $eid, $ename);
                $trending_diff = $trending_point - $event[0]['last_noti'];
                if ($trending_diff > 4) {
                    //  $this->apple_trend($uid, $eid, $ename);
                    $update_data['last_noti'] = $trending_point;
                }
                $update_data['trending_point'] = $trending_point;
                $this->common_model->UPDATEDATA('tbl_events', array('event_id' => $eid), $update_data);

                echo json_encode($output);
            }
        }
    }

    function addeventcomment() {
        $output = array();
        $update_data = array();
        $uid = $this->input->post('user_id');
        $eid = $this->input->post('event_id');
        $location = $this->input->post('location');
        $comment = $this->input->post('comment');
        if ($uid == NULL || $eid == NULL || $location == NULL || $comment == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
            echo json_encode($output);
        } else if ($uid != '' || $eid != '' || $location != '' || $comment != '') {
            // date_default_timezone_set("Asia/Calcutta"); 
            $date = $this->input->post('ratingtime');
            $trending_point = 1;
            $event = $this->common_model->get_sql_select_data('tbl_events', array('event_id' => $eid), array('trending_point', 'last_noti', 'event_name'));
            if ($event[0]['trending_point']) {
                $trending_point = $event[0]['trending_point'] + 1;
            }

            $trending_diff = $trending_point - $event[0]['last_noti'];
            if ($trending_diff > 4) {
                //$this->apple_trend($uid, $eid, $event[0]['event_name']);
                $update_data['last_noti'] = $trending_point;
            }
            $update_data['trending_point'] = $trending_point;
            $this->common_model->UPDATEDATA('tbl_events', array('event_id' => $eid), $update_data);

            // $this->common_model->UPDATEDATA('tbl_events', array('event_id' => $eid), array('trending_point' => $trending_point));

            $comment = mysql_real_escape_string($comment);

            $this->common_model->INSERTDATA('tbl_event_feeds', array('event_id' => $eid, 'user_id' => $uid, 'feed' => $comment, 'type' => 'Comment', 'location' => $location, 'date' => $date));
            $this->apple_post($uid, $eid, $event[0]['event_name'], 'comment');

            $output['success'] = 1;
            $output['msg'] = "Success";
            echo json_encode($output);
        }
    }

    function addeventpicture() {
        $output = array();
        $update_data = array();
        $uid = $this->input->post('user_id');
        $eid = $this->input->post('event_id');
        $location = $this->input->post('location');
        $img1 = $this->input->post('image');
        if ($uid == NULL || $eid == NULL || $location == NULL || $img1 == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
            echo json_encode($output);
        } else if ($uid != '' || $eid != '' || $location != '' || $image != '') {
            // date_default_timezone_set("Asia/Calcutta"); 
            $date = $this->input->post('ratingtime');
            $trending_point = 2;

            $event = $this->common_model->get_sql_select_data('tbl_events', array('event_id' => $eid), array('trending_point', 'last_noti', 'event_name'));
            if (isset($event[0]['trending_point'])) {
                $trending_point = $event[0]['trending_point'] + 2;
            }
            // $this->common_model->UPDATEDATA('tbl_events', array('event_id' => $eid), array('trending_point' => $trending_point));

            $trending_diff = $trending_point - $event[0]['last_noti'];
            if ($trending_diff > 4) {
                // $this->apple_trend($uid, $eid, $event[0]['event_name']);
                $update_data['last_noti'] = $trending_point;
            }
            $update_data['trending_point'] = $trending_point;
            $this->common_model->UPDATEDATA('tbl_events', array('event_id' => $eid), $update_data);

            //  $this->common_model->UPDATEDATA('tbl_events', array('event_id' => $eid), array('trending_point' => $trending_point));

            $img1 = str_replace('data:image/jpg;base64,', '', $img1);
            $img1 = str_replace(' ', '+', $img1);
            $data1 = base64_decode($img1);
            $file = uniqid() . '.jpg';
            $tfile = "upload/" . $file;
            $success = file_put_contents($tfile, $data1);
            $path = "upload/" . $file;

            $this->common_model->INSERTDATA('tbl_event_feeds', array('event_id' => $eid, 'user_id' => $uid, 'feed' => $file, 'type' => 'Picture', 'location' => $location, 'date' => $date));
            $this->apple_post($uid, $eid, $event[0]['event_name'], 'image');
            $output['success'] = 1;
            $output['msg'] = "Success";
            echo json_encode($output);
        }
    }

    function addnudges() {

        $output = array();
        $data = array();
        $data['event_id'] = $this->input->post('event_id');
        $data['nudges_to'] = $this->input->post('nudges_to');
        $data['nudges_by'] = $this->input->post('nudges_by');
        $data['facebook_id'] = $this->input->post('facebook_id');
        $data['nudges'] = $this->input->post('nudges');

        if ($data['event_id'] != '' && $data['nudges_to'] != '' && $data['nudges_by'] != '' && $data['facebook_id'] != '' && $data['nudges'] != '') {
            $event = $data['event_id'];
            $user_to = $data['nudges_to'];
            $user_by = $data['nudges_by'];
            $facebook = $data['facebook_id'];
            $nudges = mysql_real_escape_string($data['nudges']);

            $query = $this->common_model->INSERTDATA('tbl_nudges', array('user_to' => $user_to, 'user_by' => $user_by, 'facebook_id' => $facebook, 'nudges' => $nudges, 'event_id' => $event, 'status' => 0));
            if ($query) {
                $output['success'] = 1;
                $output['msg'] = "Nudges Submitted";
                echo json_encode($output);
            } else {
                $output['success'] = 0;
                $output['msg'] = "Nudges Not Submitted";
                echo json_encode($output);
            }
        } else {

            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
            echo json_encode($output);
        }
    }

    function getnudges() {

        $output = array();
        $data = array();
        $data['user_id'] = $this->input->post('user_id');
        $data['event_id'] = $this->input->post('event_id');
        $data['nudges_no'] = $this->input->post('nudges_no');
        if ($data['user_id'] == NULL || $data['event_id'] == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
            echo json_encode($output);
        } else if ($data['user_id'] != '' || $data['event_id'] != '') {

            $event_id = $data['event_id'];
            $id = $data['user_id'];
            $no = $data['nudges_no'];
            $order_by = 'id DESC';
            $sql = $this->common_model->get_sql_select_data('tbl_nudges', array('event_id' => $event_id, 'user_to' => $id, 'status' => 0), array('nudges', 'facebook_id', 'user_by', 'id'), null, $order_by);

            if (count($sql) > 0 && $no <= count($sql)) {
                $i = 1;
                foreach ($sql as $row) {
                    if ($i == $no) {
                        $output['nudges'] = $row['nudges'];
                        $output['user_id'] = $row['user_by'];
                        $userid = $row['user_by'];
                        $sql_face = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $userid), array('userFacebookId', 'userImage', 'userName'));

                        foreach ($sql_face as $row_face) {
                            $output['facebook_id'] = $row_face['userFacebookId'];
                            $output['username'] = $row_face['userName'];

                            if ($row_face['userImage']) {
                                $image = base_url() . 'upload/' . $row_face['userImage'];
                            } else {
                                $image = '';
                            }
                            $output['userimage'] = $image;
                        }

                        $nudges_id = $row['id'];
                        $output['success'] = 1;
                        $this->common_model->UPDATEDATA('tbl_nudges', array('id' => $nudges_id), array('status' => 1));
                    }

                    $i++;
                }

                echo json_encode($output);
            } else {
                $output['success'] = 0;
                $output['msg'] = "No data were found";
                echo json_encode($output);
            }
        }
    }

    function updateuserInfo() {
        $output = array();

        $uid = $this->input->post('user_id');
        $type = $this->input->post('type');
        $venuename = $this->input->post('venuename');
        $stagename = $this->input->post('stagename');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $img1 = $this->input->post('image');
        $name = $this->input->post('Name');
        if (empty($name)) {
            $name = $stagename;
        }


        if ($uid == NULL || $type == NULL || $email == NULL || $img1 == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
            echo json_encode($output);
        } else if ($uid != '' || $type != '' || $email != '' || $img1 != '') {
            date_default_timezone_set("Asia/Calcutta");
            $date = date("Y-m-d H:i:s");

            $img1 = str_replace('data:image/jpg;base64,', '', $img1);
            $img1 = str_replace(' ', '+', $img1);
            $data1 = base64_decode($img1);
            $file = uniqid() . '.jpg';
            $tfile = "upload/" . $file;
            $success = file_put_contents($tfile, $data1);
            $path = "upload/" . $file;


            $where = array('userid' => $uid);
            if ($type == 'venue' || $type == 'vanue') {
                $fields = array('venuename' => $venuename, 'stagename' => $stagename, 'userEmail' => $email, 'address' => $address, 'userImage' => $file);
            } else {
                $fields = array('userName' => $name, 'fullname' => $name, 'stagename' => $stagename, 'userEmail' => $email, 'userImage' => $file);
            }
            $categories = $this->common_model->UPDATEDATA('tbl_user', $where, $fields);
            $field_select = 'userFacebookId';
            $user = $this->common_model->get_sql_select_data('tbl_user', $where);
            $where_user_id = array('user_id' => $user[0]['userFacebookId']);

            if ($type == 'Performers') {
                $field_artist = array('artist_name' => $stagename, 'artist_image' => $file);
                $this->common_model->UPDATEDATA('tbl_artist', $where_user_id, $field_artist);
            }
            if ($type == 'Promoter') {
                $field_promoter = array('name' => $stagename, 'image' => $file);

                $this->common_model->UPDATEDATA('tbl_responser', $where_user_id, $field_promoter);
            }

            $output['success'] = 1;
            $output['msg'] = "Success";
            $result = $this->getUserdetailByIDsocail($uid);
            $output['userinfo'] = $result;
            $output['userinfo']['userImage'] = base_url() . 'upload/' . $file;
            $output['userinfo']['address'] = $address;
            echo json_encode($output);
        }
    }

    function facebookLoginSocial() {

        $data = array();
        $data['userEmail'] = $this->input->post('userEmail');
        $data['facebookid'] = $this->input->post('facebookid');
        $data['fbusername'] = $this->input->post('fbusername');
        $data['usertype'] = $this->input->post('usertype');
        $data['artisttype'] = $this->input->post('artisttype');
        $data['stagename'] = $this->input->post('fbusername');
        $data['address'] = $this->input->post('address');
        $data['venuename'] = $this->input->post('venuename');
        $data['ProfileImage'] = $this->input->post('ProfileImage');
        $data['fullname'] = $this->input->post('fullname');
        $data['userGender'] = $this->input->post('userGender');
        $data['devicetoken'] = $this->input->post('device_token');

        $output = array();

        if ($data['userEmail'] == NULL || $data['facebookid'] == NULL || $data['fbusername'] == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Check Parameter";
            echo json_encode($output);
        } else if ($data['userEmail'] != '' || $data['facebookid'] != '' || $data['fbusername'] != '') {
            $result = $this->getfacebookidcheck($data['facebookid']);
            $userID = $this->getfacebookuserId($data['facebookid']);
            $usertype = $data['usertype'];

            if ($result == 1) {
                date_default_timezone_set("UTC");
                $logindate = date("Y-m-d H:i:s");

                $updateData['userLastLogin'] = $logindate;
                $updateData['usertype'] = $usertype;
                $updateData['userEmail'] = $data['userEmail'];

                if ($usertype == 'Artist') {
                    $updateData['artisttype'] = $data['artisttype'];
                    $updateData['stagename'] = $data['stagename'];

                    //$query="UPDATE `tbl_user` SET userLastLogin='".$logindate."' , usertype='".$data['usertype']."' , artisttype = '".$data['artisttype']."' , stagename = '".$data['stagename']."' WHERE `userFacebookId`='".$data['facebookid']."'";
                } elseif ($usertype == 'Promoter') {
                    $updateData['stagename'] = $data['stagename'];

                    //$query="UPDATE `tbl_user` SET userLastLogin='".$logindate."' , usertype='".$data['usertype']."' , stagename = '".$data['stagename']."' WHERE `userFacebookId`='".$data['facebookid']."'";
                } elseif ($usertype == 'Venue') {
                    $address = $data['address'];
                    $address = str_replace(" ", "+", $address);
                    $address = urlencode($address);
                    $ad = str_replace("'", "", $data['address']);
                    $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
                    $json = json_decode($json);

                    $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                    $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};


                    $updateData['venuename'] = $data['venuename'];
                    $updateData['address'] = $ad;
                    $updateData['lat'] = $lat;
                    $updateData['longi'] = $long;


                    //$query="UPDATE `tbl_user` SET userLastLogin='".$logindate."' , usertype='".$data['usertype']."' ,  venuename = '".$data['venuename']."' ,  address = '".$ad."' , lat = '".$lat."' , longi = '".$long."' WHERE `userFacebookId`='".$data['facebookid']."' ";
                }
                /* else	
                  {
                  $query="UPDATE `tbl_user` SET userLastLogin='".$logindate."' , usertype='".$data['usertype']."'  WHERE `userFacebookId`='".$data['facebookid']."'";
                  } */




                $this->db->where('userFacebookId', $data['facebookid']);
                $this->db->update('tbl_user', $updateData);

                //$sqlquery=mysql_query($query);

                $output['success'] = 0;
                $output['msg'] = "Facebook user Already Added";
                $result = $this->getUserdetailByID($userID);

                $output['userinfo'] = $result;
                echo json_encode($output);
            } else {
                $result = $this->getProfileCheckEmail($data['userEmail']); //Email is Present or Not in Database Function
                date_default_timezone_set("UTC");
                $logindate = date("Y-m-d H:i:s");
                if ($result == 1) {
                    //$query="UPDATE `tbl_user` SET `userFacebookId`='".$data['facebookid']."', `userName` = '".$data['fbusername']."',`userStatus` = '1',userLastLogin='".$logindate."' , fullname = '".$data['fullname']."'  , userGender = '".$data['userGender']."' WHERE `userEmail`='".$data['userEmail']."'";

                    if ($usertype == 'Artist') {

                        $sqlquery = $this->common_model->UPDATEDATA('tbl_user', array('userEmail' => $data['userEmail']), array('userLastLogin' => $logindate, 'userDeviceId' => $data['devicetoken'], 'usertype' => $data['usertype'], 'artisttype' => $data['artisttype'], 'stagename' => $data['stagename']));
                    } elseif ($usertype == 'Promoter') {

                        $sqlquery = $this->common_model->UPDATEDATA('tbl_user', array('userEmail' => $data['userEmail']), array('userLastLogin' => $logindate, 'userDeviceId' => $data['devicetoken'], 'usertype' => $data['usertype'], 'stagename' => $data['stagename']));
                    } elseif ($usertype == 'Venue') {
                        $address = $data['address'];
                        $address = str_replace(" ", "+", $address);
                        $address = urlencode($address);
                        $ad = str_replace("'", "", $data['address']);
                        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
                        $json = json_decode($json);

                        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

                        $sqlquery = $this->common_model->UPDATEDATA('tbl_user', array('userEmail' => $data['userEmail']), array('userLastLogin' => $logindate, 'userDeviceId' => $data['devicetoken'], 'usertype' => $data['usertype'], 'venuename' => $data['venuename'], 'address' => $ad, 'lat' => $lat, 'longi' => $longi));
                    } else {

                        $sqlquery = $this->common_model->UPDATEDATA('tbl_user', array('userEmail' => $data['userEmail']), array('userLastLogin' => $logindate, 'userDeviceId' => $data['devicetoken'], 'usertype' => $data['usertype']));
                    }


                    if ($sqlquery) {
                        $userID = $this->getfacebookuserId($data['facebookid']);
                        $result = $this->getUserdetailByID($userID);
                        $output['userinfo'] = $result;
                        $output['success'] = 1;
                        $output['msg'] = "Thank You For Login.";
                        echo json_encode($output);
                    } else {
                        //if any Error Occurred Then it returns a Try Again
                        $output['success'] = 0;
                        $output["msg"] = 'Error has been Occurred Please Try Again';
                        echo json_encode($output);
                    }
                } else {

                    date_default_timezone_set("UTC");
                    $date = date("Y-m-d H:i:s");
                    $file = '';
                    if ($data['ProfileImage']) {
                        $img1 = $data['ProfileImage'];
                        $img1 = str_replace('data:image/jpg;base64,', '', $img1);
                        $img1 = str_replace(' ', '+', $img1);
                        $data1 = base64_decode($img1);
                        $file = uniqid() . '.jpg';
                        $tfile = "upload/" . $file;
                        $success = file_put_contents($tfile, $data1);
                        $path = "upload/" . $file;
                    }
                    if ($usertype == 'Artist') {
                        //$query="UPDATE `tbl_user` SET userLastLogin='".$logindate."' , usertype='".$data['usertype']."' , artisttype = '".$data['artisttype']."' , stagename = '".$data['stagename']."' WHERE `userFacebookId`='".$data['facebookid']."'";


                        $query = $this->common_model->INSERTDATA('tbl_user', array('userFacebookId' => $data['facebookid'], 'userName' => $data['fbusername'], 'userEmail' => $data['userEmail'], 'fullname' => $data['fullname'], 'userDeviceId' => $data['devicetoken'], 'userStatus' => 1, 'userGender' => $data['userGender'], 'registered_date' => $date, 'userLastLogin' => $date, 'usertype' => $data['usertype'], 'userImage' => $file, 'artisttype' => $data['artisttype'], 'stagename' => $data['stagename']));
                    } elseif ($usertype == 'Promoter') {
                        //$query="UPDATE `tbl_user` SET userLastLogin='".$logindate."' , usertype='".$data['usertype']."' , stagename = '".$data['stagename']."' WHERE `userFacebookId`='".$data['facebookid']."'";

                        $query = $this->common_model->INSERTDATA('tbl_user', array('userFacebookId' => $data['facebookid'], 'userName' => $data['fbusername'], 'userEmail' => $data['userEmail'], 'fullname' => $data['fullname'], 'userDeviceId' => $data['devicetoken'], 'userStatus' => 1, 'userGender' => $data['userGender'], 'registered_date' => $date, 'userLastLogin' => $date, 'usertype' => $data['usertype'], 'userImage' => $file, 'stagename' => $data['stagename']));
                    } elseif ($usertype == 'Venue') {
                        $address = $data['address'];
                        $address = str_replace(" ", "+", $address);
                        $address = urlencode($address);
                        $ad = str_replace("'", "", $data['address']);
                        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region");
                        $json = json_decode($json);

                        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
                        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
                        //$query="UPDATE `tbl_user` SET userLastLogin='".$logindate."' , usertype='".$data['usertype']."' ,  venuename = '".$data['venuename']."' ,  address = '".$ad."' , lat = '".$lat."' , long = '".$long."' WHERE `userFacebookId`='".$data['facebookid']."'";


                        $query = $this->common_model->INSERTDATA('tbl_user', array('userFacebookId' => $data['facebookid'], 'userName' => $data['fbusername'], 'userEmail' => $data['userEmail'], 'fullname' => $data['fullname'], 'userDeviceId' => $data['devicetoken'], 'userStatus' => 1, 'userGender' => $data['userGender'], 'registered_date' => $date, 'userLastLogin' => $date, 'usertype' => $data['usertype'], 'stagename' => $data['stagename'], 'userImage' => $file, 'venuename' => $data['venuename'], 'address' => $ad, 'lat' => $lat, 'longi' => $long));
                    } else {


                        $query = $this->common_model->INSERTDATA('tbl_user', array('userFacebookId' => $data['facebookid'], 'userName' => $data['fbusername'], 'userEmail' => $data['userEmail'], 'fullname' => $data['fullname'], 'userDeviceId' => $data['devicetoken'], 'userStatus' => 1, 'userGender' => $data['userGender'], 'registered_date' => $date, 'userLastLogin' => $date, 'usertype' => $data['usertype'], 'stagename' => $data['stagename'], 'userImage' => $file));
                    }


                    $userID = $query;
                    if ($query) {
                        $output['success'] = 1;
                        $output['userID'] = $userID;
                        $result = $this->getUserdetailByID($userID);
                        $output['userinfo'] = $result;
                        $output['msg'] = "Thank You For Registration.";
                        $this->load->library('email');
                        $this->email->from('management@scenekey.com', 'Scenekey');
                        $useremil = $this->input->post('userEmail');
                        $this->email->to($useremil);
                        $this->email->set_mailtype("html");
                        //$this->email->cc('another@another-example.com');
                        //$this->email->bcc('them@their-example.com');
                        // Compose a simple HTML email message
                        $body = '<html><body>';

                        $body .= '<h3>Welcome to Scenekey!</h3>';

                        $body .= '<p>We are the next generation events platform that gets you connected to other scenesters at events! </p>';

                        $body .= '<p>Using Scenekey is easy.  Find a local event by searching on our map.  Not only can you find out when and where information, you can discover advanced real time information about the event like: which events are trending? who is there? What does it look like inside now? What are they saying? </p>';

                        $body .= '<p>When you arrive at your event Join the room!  Hit the enter button a and you will be in a virtual room with everyone in the actual room (you can only unlock the event if you are there). You may share anything you like with the community that will be posted on the big screen, or meet new people by giving them a little nudge (tap their picture). </p>';

                        $body .= '<p>Thanks for joining us on our journey to modernize your event experience.  We appreciate your support as we add many more cool features for your convenience. Feel free to give us suggestions and feedback at management@scenekey.com. </p>';

                        $body .= '-- The Scenekey Team';

                        $body .= '</body></html>';



                        $this->email->subject('Welcome to Scenekey!');
                        $this->email->message($body);

                        $this->email->send();
                        echo json_encode($output);
                    } else {
                        //if any Error Occurred Then it returns a Try Again
                        $output['success'] = 0;
                        $output["msg"] = 'an Error has been Occurred Please Try Again';
                        echo json_encode($output);
                    }
                }
            }
        }
    }

    function facebookLogin() {
        $output = array();
        $data = array();
        $data['userEmail'] = $this->input->post('userEmail');
        $data['facebookid'] = $this->input->post('facebookid');
        $data['fbusername'] = $this->input->post('fbusername');
        $data['usertype'] = $this->input->post('usertype');
        $data['artisttype'] = $this->input->post('artisttype');
        $data['devicetoken'] = $this->input->post('device_token');

        $stagename = $this->input->post('stagename');
        if (empty($stagename) || $stagename == null) {
            $data['stagename'] = $this->input->post('fbusername');
        } else {
            $data['stagename'] = $this->input->post('stagename');
        }
        $data['address'] = $this->input->post('address');
        $data['venuename'] = $this->input->post('venuename');
        $data['ProfileImage'] = $this->input->post('ProfileImage');
        $data['fullname'] = $this->input->post('fullname');
        $data['userGender'] = $this->input->post('userGender');
        if ($data['userEmail'] == NULL || $data['facebookid'] == NULL || $data['fbusername'] == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Check Parameter";
            echo json_encode($output);
        } else if ($data['userEmail'] != '' || $data['facebookid'] != '' || $data['fbusername'] != '') {
            $result = $this->getfacebookidcheck($data['facebookid']);
            $userID = $this->getfacebookuserId($data['facebookid']);

            if ($result == 1) {
                date_default_timezone_set("UTC");
                $logindate = date("Y-m-d H:i:s");

                $img1 = $data['ProfileImage'];
                $img1 = str_replace('data:image/jpg;base64,', '', $img1);
                $img1 = str_replace(' ', '+', $img1);
                $data1 = base64_decode($img1);
                $file = uniqid() . '.jpg';
                $tfile = "upload/" . $file;
                $success = file_put_contents($tfile, $data1);
                $path = "upload/" . $file;

                $this->common_model->UPDATEDATA('tbl_user', array('userFacebookId' => $data['facebookid']), array('userDeviceId' => $data['devicetoken'], 'userLastLogin' => $logindate, 'usertype' => $data['usertype'], 'artisttype' => $data['artisttype'], 'stagename' => $data['stagename'],'userImage'=>$data['ProfileImage']));

                if ($data['stagename'] != '') {
                    $name_insert = $data['stagename'];
                } else {
                    $name_insert = $data['fullname'];
                }

                $where_art = array('user_id' => $data['facebookid']);
                $artist_exits = $this->common_model->get_sql_select_data('tbl_artist', $where_art);
                $promtor_exits = $this->common_model->get_sql_select_data('tbl_responser', $where_art);

                if ($data['usertype'] == 'Performers') {
                    $this->common_model->DELETEDATA('tbl_responser', $where_art);

                    if ($artist_exits) {
                        $fields = array('artist_name' => $name_insert, 'artist_image' => $file);
                        $this->common_model->UPDATEDATA('tbl_artist', $where_art, $fields);
                    } else {
                        $fields = array('user_id' => $data['facebookid'], 'artist_name' => $name_insert, 'artist_image' => $file);
                        $this->common_model->INSERTDATA('tbl_artist', $fields);
                    }
                }

                if ($data['usertype'] == 'Promoter') {
                    $this->common_model->DELETEDATA('tbl_artist', $where_art);

                    if ($promtor_exits) {

                        $fields_promoter = array('name' => $name_insert, 'image' => $file);
                        $this->common_model->UPDATEDATA('tbl_responser', $where_art, $fields_promoter);
                    } else {
                        $fields_promoter = array('user_id' => $data['facebookid'], 'name' => $name_insert, 'image' => $file);
                        $this->common_model->INSERTDATA('tbl_responser', $fields_promoter);
                    }
                }

                $output['success'] = 0;
                $output['msg'] = "Facebook user Already Added";
                $result = $this->getUserdetailByIDsocail($userID);

                $output['userinfo'] = $result;
                $output['userinfo']['address'] = $data['address'];

                echo json_encode($output);
            } else {
                $result = $this->getProfileCheckEmail($data['userEmail']); //Email is Present or Not in Database Function
                date_default_timezone_set("UTC");
                $logindate = date("Y-m-d H:i:s");
                if ($result == 1) {

                    $sqlquery = $this->common_model->UPDATEDATA('tbl_user', array('userEmail' => $data['userEmail']), array('userFacebookId' => $data['facebookid'], 'userName' => $data['fbusername'], 'userDeviceId' => $data['devicetoken'], 'userStatus' => 1, 'userLastLogin' => $logindate, 'fullname' => $data['fullname'], 'userGender' => $data['userGender'],'userImage'=>$data['ProfileImage']));
                    if ($sqlquery) {
                        $userID = $this->getfacebookuserId($data['facebookid']);
                        $result = $this->getUserdetailByIDsocail($userID);
                        $output['userinfo'] = $result;
                        $output['userinfo']['address'] = $data['address'];

                        $output['success'] = 1;
                        $output['msg'] = "Thank You For Login.";
                        echo json_encode($output);
                    } else {
                        $output['success'] = 0;
                        $output["msg"] = 'Error has been Occurred Please Try Again';
                        echo json_encode($output);
                    }
                } else {

                    date_default_timezone_set("UTC");
                    $date = date("Y-m-d H:i:s");

                    $img1 = $data['ProfileImage'];
                    $img1 = str_replace('data:image/jpg;base64,', '', $img1);
                    $img1 = str_replace(' ', '+', $img1);
                    $data1 = base64_decode($img1);
                    $file = uniqid() . '.jpg';
                    $tfile = "upload/" . $file;
                    $success = file_put_contents($tfile, $data1);
                    $path = "upload/" . $file;


                    $sqlquery = $userID = $this->common_model->INSERTDATA('tbl_user', array('userFacebookId' => $data['facebookid'], 'userName' => $data['fbusername'], 'userEmail' => $data['userEmail'], 'fullname' => $data['fullname'], 'userDeviceId' => $data['devicetoken'], 'userStatus' => 1, 'userGender' => $data['userGender'], 'registered_date' => $date, 'userLastLogin' => $date, 'usertype' => $data['usertype'], 'stagename' => $data['stagename'], 'artisttype' => $data['artisttype'], 'userImage' => $file));


                    if ($data['stagename'] != '') {
                        $name_insert = $data['stagename'];
                    } else {
                        $name_insert = $data['fullname'];
                    }
                    $where_art = array('user_id' => $data['facebookid']);
                    $artist_exits = $this->common_model->get_sql_select_data('tbl_artist', $where_art);
                    $promtor_exits = $this->common_model->get_sql_select_data('tbl_responser', $where_art);
                    if (!$artist_exits) {
                        if ($data['usertype'] == 'Performers') {

                            $fields = array('artist_name' => $name_insert, 'user_id' => $data['facebookid'], 'artist_image' => $file);
                            $this->common_model->INSERTDATA('tbl_artist', $fields);
                        }
                    }
                    if (!$promtor_exits) {

                        if ($data['usertype'] == 'Promoter') {
                            $fields_promoter = array('name' => $name_insert, 'user_id' => $data['facebookid'], 'image' => $file);
                            $this->common_model->INSERTDATA('tbl_responser', $fields_promoter);
                        }
                    }
                    if ($sqlquery) {
                        $output['success'] = 1;
                        $output['userID'] = $userID;
                        $result = $this->getUserdetailByIDsocail($userID);
                        $output['userinfo'] = $result;
                        $output['userinfo']['address'] = $data['address'];
                        $output['msg'] = "Thank You For Registration.";
                        $this->load->library('email');
                        $this->email->from('management@scenekey.com', 'Scenekey');
                        $useremil = $this->input->post('userEmail');
                        $this->email->to($useremil);
                        $this->email->set_mailtype("html");

                        $body = '<html><body>';

                        $body .= '<h3>Welcome to Scenekey!</h3>';

                        $body .= '<p>We are the next generation events application whose goal is to enhance your event experience by getting you plugged into the community at all of your events.  We hope to provide you with really fun and convenient features that you have always wished you had.</p>';

                        $body .= '<p>Using Scenekey is easy.  Find a local event by searching on our map.  Not only can you find out when and where information, you can discover advanced real time information about the event by tapping into the scene to see who is there and observe social chatter.</p>';

                        $body .= '<p>When you arrive at your event Join the party!  Unlock the event by hitting the "key in" button (you can only unlock the event if you are there).  Once you have keyed in, you will be in a virtual room with everyone in the actual room.  You may share anything you like with the community that will be posted on the big screen, or meet new people by giving them a little nudge (tap their picture).</p>';

                        $body .= '<p>Thanks for joining us on our journey to modernize your event experience.  We appreciate your support as we add many more cool features for your convenience. Feel free to give us suggestions and feedback at management@scenekey.com.</p>';

                        $body .= '-- The Scenekey Team';

                        $body .= '</body></html>';
                        $this->email->subject('Welcome to Scenekey!');
                        $this->email->message($body);

                        $this->email->send();

                        echo json_encode($output);
                    } else {
                        $output['success'] = 0;
                        $output["msg"] = 'an Error has been Occurred Please Try Again';
                        echo json_encode($output);
                    }
                }
            }
        }
    }

    function getUserdetailByIDsocail($uid) {


        $sqlquery = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $uid));

        if ($sqlquery) {
            foreach ($sqlquery as $row) {

                $newimage = $row['userImage'];
                $path = base_url() . "upload/" . $newimage;
                $sqlarray['userID'] = $row['userid'];
                $sqlarray['email'] = $row['userEmail'];
                $sqlarray['password'] = $row['password'];
                $sqlarray['fullname'] = $row['fullname'];
                $sqlarray['userName'] = $row['userName'];
                $sqlarray['userGender'] = $row['userGender'];
                $sqlarray['userImage'] = $path;
                $sqlarray['logintime'] = $row['userLastLogin'];
                $sqlarray['stagename'] = $row['stagename'];
                $sqlarray['venuename'] = $row['venuename'];
                $sqlarray['artisttype'] = $row['artisttype'];
                //$sqlarray['logdtime']=time(); 


                if (!empty($row['fullname'])) {
                    $name = explode(" ", $row['fullname']);
                    $sqlarray['firstname'] = reset($name);
                    $sqlarray['lastname'] = end($name);
                } else {
                    $sqlarray['firstname'] = '';
                    $sqlarray['lastname'] = '';
                }
            }
            return $sqlarray;
            //print_r($sqlarray); 
        }
    }

    function getfacebookidcheck($facebookid) {

        $sqlquery = $this->common_model->get_sql_select_data('tbl_user', array('userFacebookId' => $facebookid));
        if (empty($sqlquery) || !$sqlquery) {
            return "0";
        } else {
            return "1";
        }
    }

//Get User Profile BY Using ID
    function getfacebookuserId($fbid) {

        $sqlquery = $this->common_model->get_sql_select_data('tbl_user', array('userFacebookId' => $fbid), array('userID'));
        if ($sqlquery) {
            foreach ($sqlquery as $row) {
                $sqlarray = $row['userID'];
            }
            return $sqlarray;
            //print_r($sqlarray); 
        }
    }

//Get User Details to Login Database Check for userid
    function getUserdetailByID($uid) {


        $sqlquery = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $uid));


        if ($sqlquery) {
            foreach ($sqlquery as $row) {

                $newimage = $row['userImage'];
                $path = base_url() . "upload/" . $newimage;
                $type = $row['usertype'];
                if ($type == 'Artist') {

                    $sqlarray['userID'] = $row['userid'];
                    $sqlarray['email'] = $row['userEmail'];
                    $sqlarray['password'] = $row['password'];
                    $sqlarray['fullname'] = $row['fullname'];
                    $sqlarray['userName'] = $row['userName'];
                    $sqlarray['userGender'] = $row['userGender'];
                    $sqlarray['userImage'] = $path;
                    $sqlarray['usertype'] = $row['usertype'];
                    $sqlarray['artisttype'] = $row['artisttype'];
                    $sqlarray['stagename'] = $row['stagename'];
                } else if ($type == 'Promoter') {

                    $sqlarray['userID'] = $row['userid'];
                    $sqlarray['email'] = $row['userEmail'];
                    $sqlarray['password'] = $row['password'];
                    $sqlarray['fullname'] = $row['fullname'];
                    $sqlarray['userName'] = $row['userName'];
                    $sqlarray['userGender'] = $row['userGender'];
                    $sqlarray['userImage'] = $path;
                    $sqlarray['usertype'] = $row['usertype'];
                    $sqlarray['stagename'] = $row['stagename'];
                } else if ($type == 'Venue') {

                    $sqlarray['userID'] = $row['userid'];
                    $sqlarray['email'] = $row['userEmail'];
                    $sqlarray['password'] = $row['password'];
                    $sqlarray['fullname'] = $row['fullname'];
                    $sqlarray['userName'] = $row['userName'];
                    $sqlarray['userGender'] = $row['userGender'];
                    $sqlarray['userImage'] = $path;
                    $sqlarray['usertype'] = $row['usertype'];
                    $sqlarray['venuename'] = $row['venuename'];
                    $sqlarray['address'] = $row['address'];
                    $sqlarray['lat'] = $row['lat'];
                    $sqlarray['longi'] = $row['longi'];
                } else {

                    $sqlarray['userID'] = $row['userid'];
                    $sqlarray['email'] = $row['userEmail'];
                    $sqlarray['password'] = $row['password'];
                    $sqlarray['fullname'] = $row['fullname'];
                    $sqlarray['userName'] = $row['userName'];
                    $sqlarray['userGender'] = $row['userGender'];
                    $sqlarray['userImage'] = $path;
                    $sqlarray['usertype'] = $row['usertype'];
                }
            }

            if (!empty($sqlarray['fullname'])) {
                $name = explode(" ", $sqlarray['fullname']);
                $sqlarray['firstname'] = reset($name);
                $sqlarray['lastname'] = end($name);
            } else {
                $sqlarray['firstname'] = '';
                $sqlarray['lastname'] = '';
            }


            return $sqlarray;
            //print_r($sqlarray); 
        }
    }

//Check that Email is not Present in Database Else it Returns a Error Message
    function getProfileCheckEmail($Email) {
        $sql = "SELECT * FROM tbl_user WHERE userEmail ='" . $Email . "'";

        $sqlquery = $this->common_model->get_sql_select_data('tbl_user', array('userEmail' => $Email));

        if (!$sqlquery || empty($sqlquery)) {
            return "0";
        } else {
            return "1";
        }
    }

//Check that Username is not Present in Database Else it Returns a Error Message
    function getProfileUsername($uname) {

        $sqlquery = $this->common_model->get_sql_select_data('tbl_user', array('userName' => $uname));

        if ($num == 0) {
            return "0";
        } else {
            return "1";
        }
    }

    function addeventrating_new() {
        $output = array();
        $uid = $this->input->post('user_id');
        $eid = $this->input->post('event_id');
        $location = $this->input->post('location');
        $rating = $this->input->post('rating');
        $ratingtime = $this->input->post('ratingtime');


        if ($uid == NULL || $eid == NULL || $location == NULL) {
            $output['success'] = 0;
            $output['msg'] = "Please check parameters";
            echo json_encode($output);
        } else if ($uid != '' || $eid != '' || $location != '') {
            // date_default_timezone_set("Asia/Calcutta"); 
            $date = date("Y-m-d H:i:s");

            $avg = $this->input->post('avg');
            if ($rating) {
                $rr = str_replace('\"', '""', $rating);
                $rr1 = str_replace('""', '"', $rr);
                $rr2 = str_replace("\\'", "", $rr1);
                $array = json_decode($rr2);

                ///die;
                for ($k = 0; $k < count($array); $k++) {
                    $artist_id = $array[$k]->id;
                    $type = $array[$k]->type;
                    $rt = $array[$k]->rating;
                    $aname = $array[$k]->name;
                    $num1 = $this->common_model->get_sql_select_data('tbl_rating', array('artist_id' => $artist_id, 'user_id' => $uid, 'event_id' => $eid, 'type' => $type));
                    if (!$num1) {
                        $query = $this->common_model->INSERTDATA('tbl_rating', array('artist_id' => $artist_id, 'user_id' => $uid, 'event_id' => $eid, 'type' => $type, 'rating' => $rt));
                    } else {

                        $sid = $num1[0]['id'];

                        $this->common_model->UPDATEDATA('tbl_rating', array('id' => $sid), array('artist_id' => $artist_id, 'user_id' => $uid, 'event_id' => $eid, 'type' => $type, 'rating' => $rt));
                    }
                    $fields = array("ROUND(AVG(`rating`),2)  as avg,count(rating) as count");
                    $where_artist = array('artist_id' => $artist_id);
                    $artist_rating = $this->common_model->get_sql_select_data('tbl_rating', $where_artist, $fields);

                    $fields_update = array('avg_rating' => $artist_rating[0]['avg']);
                    $this->common_model->UPDATEDATA('tbl_artist', $where_artist, $fields_update);

                    $this->common_model->DELETEDATA('tbl_event_feeds', array('event_id' => $eid, 'user_id' => $uid, 'artist_id' => $artist_id, 'type' => 'Rating'));
                    if ($artist_id) {
                        $ratetype = 'Artist';
                    } else {
                        $ratetype = 'Event';
                    }

                    $query = $this->common_model->INSERTDATA('tbl_event_feeds', array('event_id' => $eid, 'user_id' => $uid, 'feed' => $rt, 'type' => 'Rating', 'location' => $location, 'date' => $ratingtime, 'artist_id' => $artist_id, 'hello' => $aname, 'ratetype' => $ratetype));

                    $row4 = $this->common_model->get_sql_select_data('tbl_rating', array('artist_id' => $artist_id, 'type' => $type), array('SUM(rating) AS rating'));
                    $rating = $row4[0]['rating'];


                    $sql6 = $this->common_model->ratingcount($artist_id, $type);

                    $nyt = $sql6[0]['count'];
                    if ($nyt == 0) {
                        $total = '0';
                    } else {
                        $total = $rating / $nyt;
                    }

                    $this->common_model->UPDATEDATA('tbl_artist', array('artist_id' => $artist_id), array('avg_rating' => $total, 'noofusers' => $nyt));
                }
            } else {

                $query = $this->common_model->INSERTDATA('tbl_rating', array('event_id' => $eid, 'user_id' => $uid, 'type' => 'event', 'rating' => $avg));
            }
            $fields_event = array("ROUND(AVG(`rating`),2)  as avg,count(rating) as count");
            $where_event_id = array('event_id' => $eid);
            $event_avg_rating = $this->common_model->get_sql_select_data('tbl_rating', $where_event_id, $fields_event);
            $fields_update_event = array('avg_rating' => $event_avg_rating[0]['avg']);
            $this->common_model->UPDATEDATA('tbl_events', $where_event_id, $fields_update_event);
            $this->common_model->UPDATEDATA('tbl_responser', $where_event_id, $fields_update_event);

            $event_avg_venue = $this->common_model->get_sql_select_data('tbl_events', $where_event_id);
            $venue_avg_rating = $this->common_model->get_sql_select_data('tbl_events', array('venue_id' => $event_avg_venue[0]['venue_id']), array("ROUND(AVG(`avg_rating`),2)  as avg_event"));
            $this->common_model->UPDATEDATA('tbl_venue', array('venue_id' => $event_avg_venue[0]['venue_id']), array('avg_rating_venue' => $venue_avg_rating[0]['avg_event']));



            $sql4 = $this->common_model->get_sql_select_data('tbl_userevent_artist', array('event_id' => $eid, 'type' => 'artist'));
            $sum = 0;
            $numbers = count($sql4);
            $j = 0;
            foreach ($sql4 as $row4) {
                if ($row4['type'] == 'artist') {
                    $row5 = $this->common_model->get_sql_select_data('tbl_artist', array('artist_id' => $row4['artist_id']));
                } else {
                    $row5 = $this->common_model->get_sql_select_data('tbl_venue', array('venue_id' => $row4['artist_id']));
                }
                $sum = $sum + $row5[0]['avg_rating'];
                $j++;
            }
            $sum;
            $numbers;
            if ($numbers < 0) {
                $total = '0';
            } else {
                $yuo = count($array);
                $total = $sum / $j;
            }

            $this->common_model->UPDATEDATA('tbl_userevent', array('eventid' => $eid), array('avg_rating' => $total));

            $vanueid = $data['vanueid'];

            $sql1 = $this->common_model->get_sql_select_data('tbl_vanue_user', array('user_id' => $uid, 'vanue_id' => $vanueid));

            $num1 = count($sql1);

            if ($num1 == '0') {

                $this->common_model->INSERTDATA('tbl_vanue_user', array('user_id' => $uid, 'vanue_id' => $vanueid));
            }


            $output['success'] = 1;
            $output['msg'] = "Success";
            echo json_encode($output);
        }
    }

    public function chkLogin() {

        $facebook_id = $this->input->post('facebook_id');
        $fullName = $this->input->post('fullname');
        $devicetoken = $this->input->post('device_token');

        $update = array();

        if (isset($facebook_id) && !empty($facebook_id)) {
            $userchk = $this->common_model->get_sql_select_data('tbl_user', array('userFacebookId' => $facebook_id));

            if (!empty($userchk)) {
                $userID = $userchk[0]['userid'];
                $profilImage = $userchk[0]['userImage'];
                $emailId = $userchk[0]['userEmail'];

                //add user profile image if not exist
                //~ if (empty($profilImage)) {
                    $img1 = $this->input->post('ProfileImage');
                    $img1 = str_replace('data:image/jpg;base64,', '', $img1);
                    $img1 = str_replace(' ', '+', $img1);
                    $data1 = base64_decode($img1);
                    $file = uniqid() . '.jpg';
                    $tfile = "upload/" . $file;
                    $success = file_put_contents($tfile, $data1);
                    $path = "upload/" . $file;

                    $update['userImage'] = $file;
               // }

                if (!empty($fullName))
                    $update['fullname'] = $fullName;

                if (count($update)) {
                    if ($devicetoken) {
                        $update['userDeviceId'] = $devicetoken;
                    }
                    $this->db->where('userFacebookId', $facebook_id);
                    $this->db->update('tbl_user', $update);
                }

                $result = $this->getUserdetailByIDsocail($userID);

                if ($result['artisttype'] == '') {
                    $result['artisttype'] = $userchk[0]['usertype'];
                }

                if (empty($emailId)) {
                    $output['success'] = 1;
                    $output['msg'] = "Facebook user first time login";
                    $output['userinfo'] = $result;
                } else {
                    $output['success'] = 0;
                    $output['msg'] = "Facebook user Already Added";
                    $output['userinfo'] = $result;
                }

                echo json_encode($output);
            } else {
                $output['success'] = 1;
                $output['msg'] = "Facebook user first time login";
                echo json_encode($output);
            }
        } else {
            $output['result'] = array('status' => 0, 'mes' => 'Please chk parameter');
            echo json_encode($output);
        }
    }

    public function SetUserStatus() {
        $user_id = $this->input->post('user_id');
        $status = $this->input->post('status');

        $update = array();

        if (isset($user_id) && !empty($user_id)) {
            $this->common_model->UPDATEDATA('tbl_user', array('userid' => $user_id), array('user_status' => $status));
            $output['result'] = array('status' => 1, 'mes' => 'Status Updated');
        } else {
            $output['result'] = array('status' => 0, 'mes' => 'Please chk parameter');
        }
        echo json_encode($output);
    }

    public function getMutualFriends() {
        $access_token = $this->input->post('access_token');
        $facebook_id = $this->input->post('facebook_id');
        if ($access_token && $facebook_id) {
            $json_string = 'https://graph.facebook.com/v2.7/' . $facebook_id . '?fields=context.fields(all_mutual_friends)&access_token=' . $access_token . '';
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $json_string);
            // curl_setopt($ch, CURLOPT_GET, TRUE);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, $msg);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $p_result = curl_exec($ch);
            $data = json_decode(trim($p_result), TRUE);
            curl_close($ch);
            if (isset($data['context']['all_mutual_friends']['data'])) {
                foreach ($data['context']['all_mutual_friends']['data'] as $mutual_friend) {
                    $output['mutual_friends'][] = array('name' => $mutual_friend['name'], 'image' => $mutual_friend['picture']['data']['url']);
                }
                $output['mutual_friend_count'] = $data['context']['all_mutual_friends']['summary']['total_count'];
                $output['result'] = array('status' => 1);
            } else {
                $output['result'] = array('status' => 0, 'mes' => 'No mutual friends were found.');
            }
        } else {
            $output['result'] = array('status' => 0, 'mes' => 'access token and facebook id missing.');
        }
        echo json_encode($output);
    }

    function testemail() {
        
          $this->load->library('email');
          $this->email->from('anilp8021@gmail.com', 'Scenekey');
          $useremil = 'anil.pal2006@gmail.com';//$this->input->post('userEmail');
          $this->email->to($useremil);
          $this->email->set_mailtype("html");

          $body = '<html><body>';

          $body .= '<h3>Welcome to Scenekey!</h3>';

          $body .= '<p>We are the next generation events platform that gets you connected to other scenesters at events! </p>';

          $body .= '<p>Using Scenekey is easy.  Find a local event by searching on our map.  Not only can you find out when and where information, you can discover advanced real time information about the event like: which events are trending? who is there? What does it look like inside now? What are they saying? </p>';

          $body .= '<p>When you arrive at your event Join the room!  Hit the enter button a and you will be in a virtual room with everyone in the actual room (you can only unlock the event if you are there). You may share anything you like with the community that will be posted on the big screen, or meet new people by giving them a little nudge (tap their picture). </p>';

          $body .= '<p>Thanks for joining us on our journey to modernize your event experience.  We appreciate your support as we add many more cool features for your convenience. Feel free to give us suggestions and feedback at management@scenekey.com. </p>';

          $body .= '-- The Scenekey Team';

          $body .= '</body></html>';



          $this->email->subject('Welcome to Scenekey!');
          $this->email->message($body);

          if($this->email->send()){
          echo "send";
          }else{
          echo "no send";
          }
         
      /*  $to = "anil.pal2006@gmail.com";
        $subject = "My subject";
        $txt = "Hello world!";
        $headers = "From: management@scenekey.com" . "\r\n" .
                "CC: somebodyelse@scenekey.com";
        if (mail($to, $subject, $txt, $headers)) {
            echo "mail send";
        } else {
            echo "No";
        }*/
    }

    public function apple($user_id, $event_id, $event_name) {
        // $user_id = 150;
        // $event_id = 429929;
        //  $event_name = "Test event";
        $passphrase = '';
        $userinfo = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $user_id), array('userName', 'fullname'));
        if ($userinfo) {
            if (isset($userinfo[0]['userName'])) {
                $key_in_by = $userinfo[0]['userName'];
            } else {
                $key_in_by = $userinfo[0]['fullname'];
            }

            $message = $key_in_by . ' has joined the room.';
            $device_token = $this->common_model->getuser_token($event_id, $user_id, null);

            if ($device_token) {
                foreach ($device_token as $token) {

                    $deviceToken = $token['userDeviceId'];
                    $ctx = stream_context_create();
                    stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-pro-cert.pem');
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                    if (!$fp)
                        exit();

                    //  echo 'Connected to APNS' . PHP_EOL;
                    $body['aps'] = array(
                        'alert' => array(
                            'badge' => '+1',
                            'body' => $message,
                            'action-loc-key' => 'Scenekey',
                        ),
                        'sound' => 'oven.caf',
                    );
                    $payload = json_encode($body);
                    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                    $result = fwrite($fp, $msg, strlen($msg));
                }
                fclose($fp);
            }
        }
    }

	
	 public function apple_post($user_id, $event_id, $event_name,$post_type) {
        // $user_id = 150;
        // $event_id = 429929;
        //  $event_name = "Test event";
        $passphrase = '';
        $userinfo = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $user_id), array('userName', 'fullname'));
        if ($userinfo) {
            if (isset($userinfo[0]['userName'])) {
                $post_by = $userinfo[0]['userName'];
            } else {
                $post_by = $userinfo[0]['fullname'];
            }

            $message = $post_by . ' has post a '.$post_type.' on '.$event_name.' event';
            $device_token = $this->common_model->getuser_token($event_id, $user_id, null);

            if ($device_token) {
                foreach ($device_token as $token) {

                    $deviceToken = $token['userDeviceId'];
                    $ctx = stream_context_create();
                    stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-pro-cert.pem');
                    stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                    $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                    if (!$fp)
                        exit();

                    //  echo 'Connected to APNS' . PHP_EOL;
                    $body['aps'] = array(
                        'alert' => array(
                            'badge' => '+1',
                            'body' => $message,
                            'action-loc-key' => 'Scenekey',
                        ),
                        'sound' => 'oven.caf',
                    );
                    $payload = json_encode($body);
                    $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                    $result = fwrite($fp, $msg, strlen($msg));
                }
                fclose($fp);
            }
        }
    }
    public function apple_trend($user_id, $event_id, $event_name) {
        // $user_id = 151;
        // $event_id = 429929;
        //  $event_name = "Test event";
        $lat = 0;
        $long = 0;

        $userinfo = $this->common_model->get_sql_select_data('tbl_user', array('userid' => $user_id), array('lat', 'longi'));
        if ($userinfo[0]['lat'] && $userinfo[0]['longi']) {
            $lat = $userinfo[0]['lat'];
            $long = $userinfo[0]['longi'];
        }
        $passphrase = '';
        $message = $event_name . ' has trend now';
        $device_token = $this->common_model->getuser_token_trend($event_id, $user_id, $lat, $long);

        if ($device_token) {
            foreach ($device_token as $token) {

                $deviceToken = $token['userDeviceId'];
                $ctx = stream_context_create();
                stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-pro-cert.pem');
                stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
                $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
                if (!$fp)
                    exit();

                //  echo 'Connected to APNS' . PHP_EOL;
                $body['aps'] = array(
                    'badge' => '+1',
                    'alert' => array(
                        'body' => $message,
                        'action-loc-key' => 'Scenekey',
                    ),
                    'sound' => 'oven.caf',
                );
                $payload = json_encode($body);
                $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
                $result = fwrite($fp, $msg, strlen($msg));
            }
            fclose($fp);
        }
    }

    public function apple_test() {
        $user_id = 150;
        $event_id = 429929;
        $event_name = "Test event";
        $passphrase = '';


        $message = ' Atishay jain has joined the room.';


        $deviceToken = '0d66010eee8f8e35490683ec9b02ba0efda17c1f412e501bc925c1fe483c1f86';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-pro-cert.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            exit();


        $body['aps'] = array(
            'alert' => array(
                'badge' => '+1',
                'body' => $message,
                'action-loc-key' => 'Scenekey',
            ),
            'sound' => 'oven.caf',
        );
        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;
// Close the connection to the server
        fclose($fp);
    }

}
