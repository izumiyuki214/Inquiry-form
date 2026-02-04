@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('auth')
<a class="header__auth" href="/a">login</a>
@endsection

@section('content')
<div class="content">
  <div class="search__title">
    <h2 class="search__title--h2">Admin</h2>
  </div>
  <form class="search-form" action="/search" method="post">
    <div class="search-form__item">
      <input class="search-form__item-input" type="text">
      <div class="search-form__item-gender">
        <select class="search-form__item-gender--select" name="" id="">
          <option value="" selected disabled>性別</option>
          <option value="">男性</option>
          <option value="">女性</option>
          <option value="">その他</option>
        </select>
      </div>
      <div class="search-form__item-categories">
        <select class="search-form__item-categories--select" name="" id="">
          <option value="" selected disabled>お問い合わせの種類</option>
          <option value=""></option>
        </select>
      </div>
      <div class="search-form__item-time">
        <input class="search-form__item-time--input" type="date">
      </div>
    </div>
    <div class="search-form__button">
      <button class="search-form__button-submit">検索</button>
    </div>
    <div class="search-form__reset">
      <a class="search-form__reset--a" href="/reset">リセット</a>
    </div>
  </form>
    
    <table class="table">
        <tbody>
            <!-- foreach ($items as $item) -->
            <tr>
                <td>id</td>
                <td>name</td>
                <td>
                    <!-- ★ここに貼る -->
                    <button
                    type="button"
                    class="btn-info btn-sm js-detail"
                    data-id="12"
                    data-name="太郎"
                    data-created="02/03"
          >
          詳細
        </button>
    </td>
</tr>
<!-- endforeach -->
</tbody>
</table>

<!-- ここからモーダル -->
<div class="modal" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">詳細</h5>
                <button class="" data-bs-dismiss="modal">X</button>
            </div>
            
            <div class="modal-body">
                <p>ID: <span id="m-id"></span></p>
                <p>名前: <span id="m-name"></span></p>
                <p>作成日: <span id="m-created"></span></p>
            </div>
            
            <div class="modal-footer">
                <form id="deleteForm" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="my-btn my-btn-danger">
                        削除
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</div>
</div>

<!-- ここからモーダルの処理 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
  const modalEl = document.getElementById('detailModal');
  const modal = new bootstrap.Modal(modalEl);

  document.querySelectorAll('.js-detail').forEach(btn => {
    btn.addEventListener('click', () => {
      // データをspanに格納
      document.getElementById('m-id').textContent = btn.dataset.id;
      document.getElementById('m-name').textContent = btn.dataset.name;
      document.getElementById('m-created').textContent = btn.dataset.created;

      document.getElementById('deleteForm').action =
        `/items/${btn.dataset.id}`;

      modal.show();
    });
  });
});
</script>
@endsection
