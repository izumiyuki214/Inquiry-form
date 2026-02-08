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
          <input type="text" class="contact-table__name-input" placeholder="例:山田" name="last_name" value="{{ old('last_name') }}">
          <input type="text" class="contact-table__name-input" placeholder="例:太郎" name="first_name" value="{{ old('first_name') }}">
        </td>
      </tr>
      @if ($errors->has('last_name'))
      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            @foreach ($errors->get('last_name') as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      @endif
      @if ($errors->has('first_name'))
      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            @foreach ($errors->get('first_name') as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      @endif
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">性別</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__gender">
          <input class="contact-table__gender-input" type="radio" name="gender" value="1" {{ old('gender') == '1' ? 'checked' : '' }} id="Choice1">
          <label class="contact-table__gender-label" for="Choice1">男性</label>
          <input class="contact-table__gender-input" type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }} id="Choice2">
          <label class="contact-table__gender-label" for="Choice2">女性</label>
          <input class="contact-table__gender-input" type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }} id="Choice3">
          <label class="contact-table__gender-label" for="Choice3">その他</label>
        </td>
      </tr>
      @if ($errors->has('gender'))
      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            @foreach ($errors->get('gender') as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      @endif
      </tr>
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">メールアドレス</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__email">
          <input type="email" class="contact-table__email-input" placeholder="例:test@example.com" name="email" value="{{ old('email') }}">
        </td>
      </tr>
      @if ($errors->has('email'))
      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            @foreach ($errors->get('email') as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      @endif
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">電話番号</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__tel">
          <input type="text" class="contact-table__tel-input" placeholder="080" name="tel1" maxlength="5" value="{{ old('tel1') }}">
          <span class="contact-table__tel-span">-</span>
          <input type="text" class="contact-table__tel-input" placeholder="1234" name="tel2" maxlength="5" value="{{ old('tel2') }}">
          <span class="contact-table__tel-span">-</span>
          <input type="text" class="contact-table__tel-input" placeholder="5678" name="tel3" maxlength="5" value="{{ old('tel3') }}">
        </td>
      </tr>
      @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            @foreach (['tel1', 'tel2', 'tel3'] as $tel)
              @foreach ($errors->get($tel) as $error)
                <li>{{ $error }}</li>
              @endforeach
            @endforeach
          </ul>
        </td>
      </tr>
      @endif
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">住所</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__address">
          <input type="text" class="contact-table__address-input" placeholder="例:東京都渋谷区千駄々谷1-2-3" name="address" value="{{ old('address') }}">
        </td>
      </tr>
      @if ($errors->has('address'))
      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            @foreach ($errors->get('address') as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      @endif
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">建物名</span>
        </th>
        <td class="contact-table__building">
          <input type="text" class="contact-table__building-input" placeholder="例:千駄々谷マンション101" name="building" value="{{ old('building') }}">
        </td>
      </tr>
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">お問い合わせの種類</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__category">
          <div class="contact-table__category--symbol">
            <select class="contact-table__category-select" name="category_id">
              <option value="" selected disabled>選択してください</option>
              @foreach ($categories as $category)
              <option value="{{ $category['id'] }}" {{ old('category_id') == $category -> id ? 'selected' : '' }}>
                {{ $category['content'] }}
              </option>
              @endforeach
              </select>
            </div>
        </td>
      </tr>
      @if ($errors->has('category_id'))
      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            @foreach ($errors->get('category_id') as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      @endif
      <tr class="contact-table__row">
        <th class="contact-table__header">
          <span class="contact-table__header-item">お問い合わせ内容</span>
          <span class="contact-table__header-required">※</span>
        </th>
        <td class="contact-table__detail">
          <textarea class="contact-table__detail-textarea" cols="30" rows="4" name="detail" maxlength="120">{{ old('detail') }}</textarea>
        </td>
      </tr>
      @if ($errors->has('detail'))
      <tr class="contact-table__row">
        <th></th>
        <td class="contact-table__error">
          <ul>
            @foreach ($errors->get('detail') as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </td>
      </tr>
      @endif
    </table>
    <div class="contact-table__button">
      <button class="contact-table__button-submit">
        確認画面
      </button>
    </div>
  </form>
</div>
@endsection
