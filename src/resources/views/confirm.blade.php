@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-form__content">
  <div class="confirm-form__heading">
    <h2>Confirm</h2>
  </div>
  <form action="/confirm" class="confirm-form" method="post">
  @csrf
    <table class="confirm-table">
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">お名前</span>
        </th>
        <td class="confirm-table__data">
          <input class="confirm-table__data-input" type="text" name="" value="太郎" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">性別</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="" value="太郎" readonly />
        </td>
      </tr>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">メールアドレス</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="" value="太郎" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">電話番号</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="" value="太郎" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">住所</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="" value="太郎" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">建物名</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="" value="太郎" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">お問い合わせの種類</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="" value="太郎" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">お問い合わせ内容</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="" value="太郎" readonly />
        </td>
      </tr>
    </table>
    <div class="confirm-table__button">
      <button class="confirm-table__button-submit">
        送信
      </button>
      <a href="" class="confirm-table__button-correct">修正</a>
    </div>
  </form>
</div>
@endsection
