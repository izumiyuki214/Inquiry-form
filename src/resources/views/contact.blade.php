@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
  <div class="contact-form__heading">
    <h2>Contact</h2>
  </div>
  <form action="/confirm" class="contact-form" method="post">
  @csrf
    <table class="contact-table">
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">お名前</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__name">
          <input type="text" class="contact-table__name-input">
          <input type="text" class="contact-table__name-input">
        </td>
      </tr>

      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            <li>文字列で入力してください</li>
            <li>文字列で入力してください</li>
          </ul>
        </td>
      </tr>

      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">性別</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__gender">
          <input class="contact-table__gender-input" type="radio" name="gender" value="1" id="Choice1">
          <label class="contact-table__gender-label" for="Choice1">男性</label>
          <input class="contact-table__gender-input" type="radio" name="gender" value="2" id="Choice2">
          <label class="contact-table__gender-label" for="Choice2">女性</label>
          <input class="contact-table__gender-input" type="radio" name="gender" value="3" id="Choice3">
          <label class="contact-table__gender-label" for="Choice3">その他</label>
        </td>
      </tr>

      </tr>
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">メールアドレス</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__email">
          <input type="text" class="contact-table__email-input">
        </td>
      </tr>

      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">電話番号</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__tel">
          <input type="text" class="contact-table__tel-input">
          <span class="contact-table__tel-span">-</span>
          <input type="text" class="contact-table__tel-input">
          <span class="contact-table__tel-span">-</span>
          <input type="text" class="contact-table__tel-input">
        </td>
      </tr>

      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">住所</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__address">
          <input type="text" class="contact-table__address-input">
        </td>
      </tr>

      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">建物名</span>
        </th>
        <td class="contact-table__building">
          <input type="text" class="contact-table__building-input">
        </td>
      </tr>

      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">お問い合わせの種類</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__detail">
          <div class="contact-table__detail--symbol">
            <select class="contact-table__detail-select" name="" id="">
              <option value="" selected disabled>選択してください</option>
              <option value=""></option>

              </select>
            </div>
        </td>
      </tr>

      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">お問い合わせ内容</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__detail">
          <textarea class="contact-table__detail-textarea" name="textarea" cols="30" rows="4"></textarea>
        </td>
      </tr>
    </table>
    <div class="contact-table__button">
      <button class="contact-table__button-submit">
        確認画面
      </button>
    </div>
  </form>
</div>
@endsection
