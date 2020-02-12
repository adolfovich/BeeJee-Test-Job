<header class="masthead">
    <div class="container d-flex align-items-center flex-column">

      <h1>Редактирование задачи #<?=$task['id']?></h1>

      <form method="POST" style="width: 100%;">
        <div class="form-group">
          <label for="editName">Имя пользователя</label>
          <input type="text" class="form-control" id="editName" value="<?=$task['name']?>" disabled>
        </div>
        <div class="form-group">
          <label for="editEmail">Имя пользователя</label>
          <input type="text" class="form-control" id="editEmail" value="<?=$task['email']?>" disabled>
        </div>

        <div class="form-group">
          <label for="editNewText">Example textarea</label>
          <textarea name="newText" class="form-control" id="editNewText" rows="3"><?=$task['text']?></textarea>
        </div>

        <button type="submit" class="btn btn-primary mb-2">Сохранить</button>
        <button class="btn btn-secondary mb-2" onClick="history.back();">Отменить</button>
      </form>

    </div>
  </header>
