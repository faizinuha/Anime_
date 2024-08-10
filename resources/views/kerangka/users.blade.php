<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free"
>
 @include('kerangkauser.style')

  <body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
       @include('kerangkauser.sidebar')
        <div class="layout-page">
         @include('kerangkauser.navbar')
          <div class="content-wrapper">
            @yield('content')
           @include('kerangkauser.footer')
          </div>
        </div>
      </div>
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
   @include('kerangkauser.script')
  </body>
</html>
