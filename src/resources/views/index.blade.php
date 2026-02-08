@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('auth')
<a class="header__auth" href="/logout">logout</a>
@endsection

@section('content')
<div class="content">
  <div class="search__title">
    <h2 class="search__title-h2">Admin</h2>
  </div>
  <form class="search-form" action="/search" method="post">
  @csrf
    <div class="search-form__item">
      <input class="search-form__item-input" type="text" placeholder="名前やメールアドレスを入力してください">
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
          <!-- foreach ($categories as $category) -->
          <option value=""></option>
          <!-- endforeach -->
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
  <div class="user-experience">
    <from class="export-form" action="/export" method="post">
      @csrf
      <div class="export-form__button">
        <button class="export-form__button-submit">
          エクスポート
        </button>
      </div>
    </from>
    <div class="pagination">
      1
    </div>
  </div>
  <div class="contact-table">
    <table class="contact-table__inner">
      <tr class="contact-table__row">
        <th class="contact-table__header">お名前</th>
        <th class="contact-table__header">性別</th>
        <th class="contact-table__header">メールアドレス</th>
        <th class="contact-table__header">お問い合わせの種類</th>
        <th class="contact-table__header"></th>
      </tr>
      <!-- foreach -->
      <tr class="contact-table__row">
        <td class="contact-table__item">山田 太郎</td>
        <td class="contact-table__item">
        @if ($contact->gender === 1)
          男性
        @elseif ($contact->gender === 2)
          女性
        @elseif ($contact->gender === 3)
          その他
        @endif
        </td>
        <td class="contact-table__item">test@example.com</td>
        <td class="contact-table__item">商品の交換について</td>
        <td class="contact-table__item">
          <button class="contact-table__detail-button btn-sm js-detail"
          data-id="1"
          data-name="山田 太郎"
          data-gender="男性"
          data-email="test@example.com"
          data-tel="08012345678"
          data-address="東京都渋谷区千駄々谷1-2-3"
          data-building="千駄々谷マンション101"
          data-category="商品の交換について"
          data-detail="届いた商品が注文した商品ではありませんでした。商品の交換をお願いします。"
          >
          詳細
          </button>
        </td>
      </tr>
      <!-- endforeach -->
    </table>
  </div>
<!-- ここからモーダル -->
  <div class="modal" id="detailModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal__close">
          <button class="modal__close-submit" data-bs-dismiss="modal">✕</button>
        </div>
        <table class="modal-table">
          <tr class="modal-table__row">
            <th class="modal-table__header">
              お名前
            </th>
            <td class="modal-table__data"><span id="name"></span></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">
              性別
            </th>
            <td class="modal-table__data"><span id="gender"></span></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">
              メールアドレス
            </th>
            <td class="modal-table__data"><span id="email"></span></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">
              電話番号
            </th>
            <td class="modal-table__data"><span id="tel"></span></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">
              住所
            </th>
            <td class="modal-table__data"><span id="address"></span></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">
              建物名
            </th>
            <td class="modal-table__data"><span id="building"></span></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">
              お問い合わせの種類
            </th>
            <td class="modal-table__data"><span id="category"></span></td>
          </tr>
          <tr class="modal-table__row">
            <th class="modal-table__header">
              お問い合わせ内容
            </th>
            <td class="modal-table__data"><span id="detail"></span></td>
          </tr>
        <table>
        <div class="modal__delete">
          <form id="deleteForm" method="post">
          @csrf
          @method('DELETE')
            <button type="submit" class="modal__delete-submit">
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
      document.getElementById('name').textContent = btn.dataset.name;
      document.getElementById('gender').textContent = btn.dataset.gender;
      document.getElementById('email').textContent = btn.dataset.email;
      document.getElementById('tel').textContent = btn.dataset.tel;
      document.getElementById('address').textContent = btn.dataset.address;
      document.getElementById('building').textContent = btn.dataset.building;
      document.getElementById('category').textContent = btn.dataset.category;
      document.getElementById('detail').textContent = btn.dataset.detail;

      document.getElementById('deleteForm').action =
        `/items/${btn.dataset.id}`;

      modal.show();
    });
  });
});
</script>
@endsection
