@if ($errors->any())
  <div class="validation-errors" role="alert" aria-labelledby="validation-errors-title">
    <div class="validation-errors-heading">
      <span class="validation-errors-icon" aria-hidden="true">!</span>
      <strong id="validation-errors-title">请检查以下内容</strong>
    </div>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
