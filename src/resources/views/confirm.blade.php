@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-form__content">
  <div class="confirm-form__heading">
    <h2>Confirm</h2>
  </div>
  <form action="/thanks" class="confirm-form" method="post">
    @csrf
    <table class="confirm-table">
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">お名前</span>
        </th>
        <td class="confirm-table__data">
          <input class="confirm-table__data-input" type="text" value="{{ $contact['last_name'] }} {{ $contact['first_name'] }}" readonly />
          <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
          <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">性別</span>
        </th>
        <td class="confirm-table__data">
          @php
              $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
          @endphp
          <input type="text" name="" value="{{ $genders[$contact['gender']] }}" readonly />
          <input type="hidden" name="gender" value="{{ $contact['gender'] }}">
        </td>
      </tr>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">メールアドレス</span>
        </th>
        <td class="confirm-table__data">
          <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">電話番号</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="tel" value="{{ $contact['tel'] }}" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">住所</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="address" value="{{ 
          $contact['address'] }}" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">建物名</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">お問い合わせの種類</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" value="{{ $category->content }}" readonly />
          <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
        </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">
          <span class="confirm-table__header-item">お問い合わせ内容</span>
        </th>
        <td class="confirm-table__data">
          <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
        </td>
      </tr>
    </table>
    <div class="confirm-table__button">
      <button type="submit" class="confirm-table__button-submit">
        送信
      </button>
      <button type="submit" name="back" value="1" class="confirm-table__button-correct">
          修正
      </button>
    </div>
  </form>
</div>
@endsection
