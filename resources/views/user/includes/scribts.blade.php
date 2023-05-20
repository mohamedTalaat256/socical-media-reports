<script>
    var HOST_URL = "";
</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#0BB783",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#D7F9EF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->



<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Theme Bundle-->


<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('assets/js/pages/crud/forms/widgets/autosize.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/file-upload/dropzonejs.js') }}"></script>
<script src="{{ asset('assets/js/pages/crud/forms/widgets/tagify.js') }}"></script>
<!--end::Page Scripts-->


<script>

var KTBootstrapDatepicker = function () {

var arrows;
if (KTUtil.isRTL()) {
 arrows = {
  leftArrow: '<i class="la la-angle-right"></i>',
  rightArrow: '<i class="la la-angle-left"></i>'
 }
} else {
 arrows = {
  leftArrow: '<i class="la la-angle-left"></i>',
  rightArrow: '<i class="la la-angle-right"></i>'
 }
}

// Private functions
var demos = function () {
 // minimum setup
 $('#kt_datepicker_1').datepicker({
  rtl: KTUtil.isRTL(),
  todayHighlight: true,
  orientation: "bottom left",
  templates: arrows
 });

 // minimum setup for modal demo
 $('#kt_datepicker_1_modal').datepicker({
  rtl: KTUtil.isRTL(),
  todayHighlight: true,
  orientation: "bottom left",
  templates: arrows
 });

 // input group layout
 $('#kt_datepicker_2').datepicker({
  rtl: KTUtil.isRTL(),
  todayHighlight: true,
  orientation: "bottom left",
  templates: arrows
 });

 // input group layout for modal demo
 $('#kt_datepicker_2_modal').datepicker({
  rtl: KTUtil.isRTL(),
  todayHighlight: true,
  orientation: "bottom left",
  templates: arrows
 });

 // enable clear button
 $('#kt_datepicker_3, #kt_datepicker_3_validate').datepicker({
  rtl: KTUtil.isRTL(),
  todayBtn: "linked",
  clearBtn: true,
  todayHighlight: true,
  templates: arrows
 });

 // enable clear button for modal demo
 $('#kt_datepicker_3_modal').datepicker({
  rtl: KTUtil.isRTL(),
  todayBtn: "linked",
  clearBtn: true,
  todayHighlight: true,
  templates: arrows
 });

 // orientation
 $('#kt_datepicker_4_1').datepicker({
  rtl: KTUtil.isRTL(),
  orientation: "top left",
  todayHighlight: true,
  templates: arrows
 });

 $('#kt_datepicker_4_2').datepicker({
  rtl: KTUtil.isRTL(),
  orientation: "top right",
  todayHighlight: true,
  templates: arrows
 });

 $('#kt_datepicker_4_3').datepicker({
  rtl: KTUtil.isRTL(),
  orientation: "bottom left",
  todayHighlight: true,
  templates: arrows
 });

 $('#kt_datepicker_4_4').datepicker({
  rtl: KTUtil.isRTL(),
  orientation: "bottom right",
  todayHighlight: true,
  templates: arrows
 });

 // range picker
 $('#kt_datepicker_5').datepicker({
  rtl: KTUtil.isRTL(),
  todayHighlight: true,
  templates: arrows
 });

  // inline picker
 $('#kt_datepicker_6').datepicker({
  rtl: KTUtil.isRTL(),
  todayHighlight: true,
  templates: arrows
 });
}

return {
 // public functions
 init: function() {
  demos();
 }
};
}();

jQuery(document).ready(function() {
KTBootstrapDatepicker.init();
});
</script>
