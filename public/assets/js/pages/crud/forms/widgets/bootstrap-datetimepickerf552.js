var KTBootstrapDatetimepicker={init:function(){$("#kt_datetimepicker_1").datetimepicker({format :'Y-MM-DD hh:mm:ss',}),$("#kt_datetimepicker_2").datetimepicker({locale:"de"}),$("#kt_datetimepicker_3").datetimepicker({format:"L"}),$("#kt_datetimepicker_4").datetimepicker({format:"LT"}),$("#kt_datetimepicker_5").datetimepicker(),$("#kt_datetimepicker_6").datetimepicker({defaultDate:"11/1/2020",disabledDates:[moment("12/25/2020"),new Date(2020,10,21),"11/22/2022 00:53"]}),$("#kt_datetimepicker_7_1").datetimepicker(),$("#kt_datetimepicker_7_2").datetimepicker({useCurrent:!1}),$("#kt_datetimepicker_7_1").on("change.datetimepicker",(function(e){$("#kt_datetimepicker_7_2").datetimepicker("minDate",e.date)})),$("#kt_datetimepicker_7_2").on("change.datetimepicker",(function(e){$("#kt_datetimepicker_7_1").datetimepicker("maxDate",e.date)})),$("#kt_datetimepicker_8").datetimepicker({inline:!0}),$("#kt_datetimepicker_9").datetimepicker(),$("#kt_datetimepicker_10").datetimepicker({locale:"de"}),$("#kt_datetimepicker_11").datetimepicker({format:"L"}),$("#kt_datetimepicker_12").datetimepicker(),$("#kt_datetimepicker_13").datetimepicker()}};jQuery(document).ready((function(){KTBootstrapDatetimepicker.init()}));