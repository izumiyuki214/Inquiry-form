@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('auth')
<form class="form" action="/logout" method="post">
  @csrf
  <button class="header__auth">logout</button>
</form>
@endsection

@section('content')
<div class="content">
  <div class="search__title">
    <h2 class="search__title-h2">Admin</h2>
  </div>
  <form class="search-form" action="/search" method="get">
  @csrf
    <div class="search-form__item">
      <input class="search-form__item-input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="名前やメールアドレスを入力してください">
      <div class="search-form__item-gender">
        <select class="search-form__item-gender--select" name="gender">
          <option value="" {{ request('gender')==='' ? 'selected' : '' }}>性別</option>
          <option value="all" {{ request('gender')==='all' ? 'selected' : '' }}>全て</option>
          <option value="1" {{ request('gender')==='1' ? 'selected' : '' }}>男性</option>
          <option value="2" {{ request('gender')==='2' ? 'selected' : '' }}>女性</option>
          <option value="3" {{ request('gender')==='3' ? 'selected' : '' }}>その他</option>
        </select>
      </div>
      <div class="search-form__item-categories">
        <select class="search-form__item-categories--select" name="category_id">
          <option value="" {{ request('category_id')==='' ? 'selected' : '' }}>お問い合わせの種類</option>
          @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ (string)request('category_id')===(string)$category->id ? 'selected' : '' }}>
            {{ $category->content }}
          @endforeach
        </select>
      </div>
      <div class="search-form__item-time">
        <input class="search-form__item-time--input" type="date" name="date" value="{{ request('date') }}">
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
    <form class="export-form" action="/export" method="get">
      <input type="hidden" name="keyword" value="{{ request('keyword') }}">
      <input type="hidden" name="gender" value="{{ request('gender') }}">
      <input type="hidden" name="category_id" value="{{ request('category_id') }}">
      <input type="hidden" name="date" value="{{ request('date') }}">
      <div class="export-form__button">
        <button class="export-form__button-submit"  type="submit">
          エクスポート
        </button>
      </div>
    </form>
    <div class="pagination">
      {{ $contacts->appends(request()->query())->links() }}
    </div>
  </div>
  <div class="contact-table">
    <table class="contact-table__inner js-col-hover">
      <tr class="contact-table__row">
        <th class="contact-table__header">お名前</th>
        <th class="contact-table__header">性別</th>
        <th class="contact-table__header">メールアドレス</th>
        <th class="contact-table__header">お問い合わせの種類</th>
        <th class="contact-table__header"></th>
      </tr>
      @foreach ($contacts as $contact) 
      <tr class="contact-table__row">
        <td class="contact-table__item">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
        <td class="contact-table__item">
          @php
              $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
          @endphp
          {{ $genders[$contact['gender']] }}
        </td>
        <td class="contact-table__item">{{ $contact['email'] }}</td>
        <td class="contact-table__item">{{ $contact['category']['content'] }}</td>
        <td class="contact-table__item">
          <button class="contact-table__detail-button btn-sm js-detail"
          data-id="{{ $contact['id'] }}"
          data-name="{{ $contact['last_name'] }} {{ $contact['first_name'] }}"
          data-gender="{{ $genders[$contact['gender']] }}"
          data-email="{{ $contact['email'] }}"
          data-tel="{{ $contact['tel'] }}"
          data-address="{{ $contact['address'] }}"
          data-building="{{ $contact['building'] }}"
          data-category="{{ $contact['category']['content'] }}"
          data-detail="{{ $contact['detail'] }}"
          >
          詳細
          </button>
        </td>
      </tr>
      @endforeach
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
        `/delete/${btn.dataset.id}`;

      modal.show();
    });
  });
});
</script>
<!-- hober機能 -->
<script>
document.querySelectorAll('.js-col-hover').forEach((table) => {
  const cells = table.querySelectorAll('th, td');

  const clear = () => {
    table.querySelectorAll('.is-col-hover')
      .forEach(el => el.classList.remove('is-col-hover'));
  };

  cells.forEach((cell) => {
    cell.addEventListener('mouseenter', () => {
      clear();
      const colIndex = cell.cellIndex;
      table.querySelectorAll('tr').forEach((tr) => {
        const target = tr.children[colIndex];
        if (target) target.classList.add('is-col-hover');
      });
    });

    cell.addEventListener('mouseleave', clear);
  });
});
</script>
@endsection
