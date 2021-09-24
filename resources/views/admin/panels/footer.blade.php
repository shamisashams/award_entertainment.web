<!-- BEGIN: Footer-->
<footer
  class="{{$configData['mainFooterClass']}} @if($configData['isFooterFixed']=== true){{'footer-fixed'}}@else {{'footer-static'}} @endif @if($configData['isFooterDark']=== true) {{'footer-dark'}} @elseif($configData['isFooterDark']=== false) {{'footer-light'}} @else {{$configData['mainFooterColor']}} @endif">
  <div class="footer-copyright">
    <div class="container">
      <span>&copy; 2019 <a href="https://insite.international/en/"
          target="_blank">Insite.International</a> All rights reserved.
      </span>
      <span class="right hide-on-small-only">
         <a href="https://github.com/makhatadze" target="_blank">Developer</a>
      </span>
    </div>
  </div>
</footer>

<!-- END: Footer-->