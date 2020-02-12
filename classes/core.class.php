<?php

class Core
{
  var $url;

  function __construct()
	{
    $this->setURL();
    $this->form = $this->form();
    $this->get = $this->setGet();
  }

  function setURL()
  {
    if(stristr($_SERVER['HTTP_HOST'], 'www.'))  {
      $this->redir('http://'.str_replace('www.', '', $_SERVER['HTTP_HOST']).$_SERVER['REQUEST_URI']);
    }

    $url = $this->_filterUrl($_SERVER['REQUEST_URI']);
    $url = substr($url, 1, strlen($url));
    $url = explode('/', $url);

    if($url){
      foreach($url as $url){
        $url = preg_replace("/\?.+/", "", $url);
        $allowUrl = $this->filterAllowUrl($url);
        if ($allowUrl != '') $this->url[] = $allowUrl;
      }
    }
  }

  function filterAllowUrl($url)
  {
    $allow_url = '';
    $allow = '?1234567890qwertyuiopasdfghjklzxcvbnm_-';
    for ($i=0; $i < strlen($url); $i++){
      for ($ii=0; $ii < strlen($allow); $ii++){
        if($url[$i] != '' && $url[$i] == $allow[$ii]) $allow_url .=  $url[$i];
      }
    }
    return $allow_url;
  }

  function _filterUrl($url)
  {
    $url = strtolower($url);
    $url = str_replace('"', '',  $url);
    $url = str_replace("'", '',  $url);
    $url = htmlspecialchars($url);
    return $url;
  }

  function setGet()
  {
    $full_url = $_SERVER['REQUEST_URI'];
    $return_arr = [];
    $url_arr = explode('?', $full_url);
    if (isset($url_arr[1])) {
      $get_params = explode('&', $url_arr[1]);
      foreach($get_params as $value) {
        $param = explode('=', $value);
        if (isset($param[1])) {
          $return_arr[$param[0]] = $param[1];
        } else {
          $return_arr[$param[0]] = '';
        }
      }
    }
    return $return_arr;
  }

  function form($form = ''){
    function array_map_recursive($callback, $value){
       if (is_array($value)) {
         return array_map(function($value) use ($callback) { return array_map_recursive($callback, $value); }, $value);
       }
       return $callback($value);
    }
    if(!$form) $form = $_POST;

    if ($form) {
      $form = array_map_recursive('trim', $form);
      return $form;
    } else {
      return FALSE;
    }
  }

  public function getTasks($sort = '', $direct = '', $page = 1)
  {
    global $db;
    $perPage = 3;

    $countTasks = $db->getOne("SELECT COUNT(*) FROM tasks");

    $pages = ceil($countTasks / $perPage);

    if ($page == 1) {
      $startRow = 0;
    } else {
      $startRow = ($page * $perPage) - $perPage;
    }

    $limit = ' LIMIT '.$perPage.' OFFSET '.$startRow;

    if ($sort) {
      if ($direct == 'up') {
        $dir = 'ASC';
      } else {
        $dir = 'DESC';
      }
      $order = ' ORDER BY '.$sort.' '.$dir;
    } else {
      $order = ' ORDER BY id DESC';
    }

    $tasks = $db->getAll("SELECT * FROM tasks".$order.$limit);

    $html = [];
    $html['table'] = '';
    foreach ($tasks as $task) {
      $html['table'] .= '<tr>';
        $html['table'] .= '<th scope="row">'.$task['id'].'</th>';
        $html['table'] .= '<td>'.$task['name'].'</td>';
        $html['table'] .= '<td>'.$task['email'].'</td>';
        $html['table'] .= '<td>'.$task['text'].'</td>';
        if ($task['status']) {
          $status = '<span class="badge badge-success">Выполнено</span><br>';
        } else {
          $status = '';
        }
        if ($task['edited']) {
          $edited = '<span class="badge badge-info">Отредактировано администратором</span>';
        } else {
          $edited = '';
        }
        $html['table'] .= '<td>'.$status.$edited.'</td>';
        if ($this->isLogin()) {
          if (!$task['status']) {
            $html['table'] .= '<td><form id="done'.$task['id'].'" method="GET"><input name="done" value="'.$task['id'].'" type="checkbox" class="form-check-input" onChange=(document.getElementById(\'done'.$task['id'].'\').submit())></form></td>';
          } else {
            $html['table'] .= '<td></td>';
          }

          $html['table'] .= '<td><a href="edit?id='.$task['id'].'">Редактировать</a></td>';
        }
      $html['table'] .= '</tr>';
    }

    if ($sort) {
      $sortLink = '?sort='.$sort.'&direct='.$direct.'&page=';
    } else {
      $sortLink = '?page=';
    }
    $html['pagination'] = '';
    if ($page == $pages && ($page - 2 > 1)) $html['pagination'] .= '<li class="page-item"><a class="page-link" href="'.$sortLink.($page - 2).'">'.($page - 2).'</a></li>';
    if ($page > 1 && ($page - 1 >= 1)) $html['pagination'] .= '<li class="page-item"><a class="page-link" href="'.$sortLink.($page - 1).'">'.($page - 1).'</a></li>';
    $html['pagination'] .= '<li class="page-item active"><a class="page-link" href="#">'.$page.'</a></li>';
    if ($page < $pages) $html['pagination'] .= '<li class="page-item"><a class="page-link" href="'.$sortLink.($page + 1).'">'.($page + 1).'</a></li>';
    if ($page == 1 && $pages > 2) $html['pagination'] .= '<li class="page-item"><a class="page-link" href="'.$sortLink.($page + 2).'">'.($page + 2).'</a></li>';

    return $html;
  }

  public function logIn($user)
  {
    global $db;
    $_SESSION['user'] = '$user';
    $db->query("UPDATE users SET session = ?s", session_id());
  }

  public function logOut()
  {
    session_destroy();
  }

  public function isLogin()
  {
    global $db;

    if (isset($_SESSION['user'])) {
      $session = $db->getOne("SELECT session FROM users WHERE login = ?s", $_SESSION['user']);
      if ($session = session_id()) {
        return TRUE;
      }
    }

    return FALSE;
  }

}
