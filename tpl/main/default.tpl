<div class="portfolio-modal modal fade show" id="newTask" tabindex="-1" role="dialog" aria-labelledby="newTaskLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">
          <i class="fas fa-times"></i>
        </span>
      </button>
      <div class="modal-body text-center">
        <div class="container">
          <?php if ($error) { ?>
          <div class="alert alert-danger" role="alert"><?=$msg_text?></div>
          <?php } ?>
          <div class="row justify-content-center">

            <form method="POST">
              <div class="form-group ">
                <label for="newTaskUserName">Имя пользователя</label>
                <input name="login" type="login" class="form-control" id="newTaskUserName" placeholder="Введите имя пользователя" value="<?php if ($error) echo $form['login'];?>">
              </div>
              <div class="form-group ">
                <label for="newTaskEmail">Email</label>
                <input name="email" type="email" class="form-control" id="newTaskEmail" placeholder="Введите email" value="<?php if ($error) echo $form['email'];?>">
              </div>
              <div class="form-group">
                <label for="newTaskText">Текст</label>
                <textarea name="text" class="form-control" id="newTaskText" rows="3"><?php if ($error) echo $form['text'];?></textarea>
              </div>

              <div class="">
                <button type="submit" id="newTaskSave" class="btn btn-primary">
                  <i class="fa fa-save fa-fw" aria-hidden="true"></i>
                  Сохранить
                </button>
                <button class="btn btn-secondary" href="#" data-dismiss="modal">
                  <i class="fas fa-times fa-fw"></i>
                  Отмена
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<header class="masthead">
    <div class="container d-flex align-items-center flex-column">
      <?php if ($saved) { ?>
      <div class="alert alert-success" role="alert">Задача успешо добавлена!</div>
      <?php } ?>
  		<table class="table">
  		  <thead>
  			<tr>
  			  <th scope="col">#</th>
  			  <th scope="col">
            Имя пользователя
            <a href="?sort=name&direct=up<?=$sort_page?>"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
            <a href="?sort=name&direct=down<?=$sort_page?>"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
          </th>
  			  <th scope="col">
            Email
            <a href="?sort=email&direct=up<?=$sort_page?>"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
            <a href="?sort=email&direct=down<?=$sort_page?>"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
          </th>
  			  <th scope="col">Текст задачи</th>
  			  <th scope="col">
            Статус
            <a href="?sort=status&direct=up<?=$sort_page?>"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>
            <a href="?sort=status&direct=down<?=$sort_page?>"><i class="fa fa-arrow-down" aria-hidden="true"></i></a>
          </th>
          <?php if ($core->isLogin()) { ?>
          <th></th>
          <th></th>
          <?php } ?>
  			</tr>
  		  </thead>
  		  <tbody>
        <?=$tasks['table']?>
  		  </tbody>
  		</table>

  		<nav aria-label="Page navigation example">
  		  <ul class="pagination">
          <?=$tasks['pagination']?>
  		  </ul>
  		</nav>

    </div>
  </header>
