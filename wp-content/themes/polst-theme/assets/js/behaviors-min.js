!function($){jQuery("ul.js-superfish").superfish({delay:700,animation:{opacity:"show"},speed:100,autoArrows:!0,disableHI:!0,speedOut:0}),jQuery("body").hasClass("single-post")&&jQuery('.menu a  span:contains("News")').parents("li.menu-item").addClass("current-menu-ancestor"),jQuery("body").hasClass("single-blog")&&(jQuery('.menu a span:contains("Resources")').parents("li.menu-item").addClass("current-menu-ancestor"),jQuery('.menu a  span:contains("Blog")').parents("li.menu-item").addClass("current-menu-item")),jQuery("body").hasClass("page-template-page_news")&&jQuery(".archive-pagination").clone().prependTo("main.content").addClass("top-pagination"),$(".module-image-carousel").slick({dots:!0,nav:!0,autoplay:!0,autoplaySpeed:5e3,prevArrow:'<span class="icon-arrow-left"></span>',nextArrow:'<span class="icon-arrow-right"></span>'}),$(".entry-content").fitVids(),$("#print-page").click(function(){window.print()}),$(".js-open-modal").click(function(e){var a=$(this).attr("data-target");$(a).fadeIn("fast"),$("body").addClass("modal-open"),e.preventDefault()}),$(".js-close-modal").click(function(){$(".js-modal-handler").fadeOut("fast"),$("body").removeClass("modal-open")})}(jQuery),jQuery(document).ready(function(){if(jQuery(function(){jQuery('[data-toggle="tooltip"]').length>0&&jQuery('[data-toggle="tooltip"]').tooltip()}),jQuery(".data_table").length>0){var e=jQuery("#resources_table").DataTable({paging:!0,pageLength:20,stateSave:!1,scrollX:!0,columnDefs:[{targets:[5],visible:!1,searchable:!0},{targets:[6],visible:!1,searchable:!0}],aaSorting:[]});jQuery(".resource-filter-select").change(function(){var a=jQuery(".resource-filter-select").map(function(){return jQuery(this).val()}).get();a=a.join(" "),e.search(a).draw()}),jQuery(".js-reset-filters").click(function(a){var n=jQuery(".resource-filter-select").map(function(){return jQuery(this).val("")}).get();e.search(n).draw(),e.search("").draw()}),jQuery("#nla_table").DataTable({paging:!0,pageLength:20,info:!0,aaSorting:!1}),jQuery(".page-id-3723 .faq__table, .page-id-65 .faq__table").DataTable({paging:!1,info:!0,aaSorting:!1})}}),jQuery(window).load(function(){var e=0,a=0,n=[],t,s,r=0;jQuery(".eqh").each(function(){if(t=jQuery(this),r=t.position().top,a!==r){for(s=0;s<n.length;s++)n[s].height(e);n.length=0,a=r,e=t.height(),n.push(t)}else n.push(t),e=e<t.height()?t.height():e;for(s=0;s<n.length;s++)n[s].height(e)})}),function(e,$,a){"use strict";function n(){var e=$(this),a=e.next("nav.nav-primary "),n="class";e.addClass($(a).attr("class")),$(a).attr("id")&&(n="id"),e.attr("id","mobile-"+$(a).attr(n))}function t(){var e=$("button[id^=mobile-]").attr("id");void 0!==e&&(i(e),o(e),u(e))}function s(){var e=$(this);d(e,"aria-pressed"),d(e,"aria-expanded"),e.toggleClass("activated"),e.next("nav.nav-primary , .sub-menu").slideToggle("fast")}function r(){var e=$(this),a=e.closest(".menu-item").siblings();d(e,"aria-pressed"),d(e,"aria-expanded"),e.toggleClass("activated"),e.next(".sub-menu").slideToggle("fast"),a.find("."+f).removeClass("activated").attr("aria-pressed","false"),a.find(".sub-menu").slideUp("fast")}function i(e){"function"==typeof $(".js-superfish").superfish&&("none"===l(e)?$(".js-superfish").superfish({delay:100,animation:{opacity:"show",height:"show"},dropShadows:!1}):$(".js-superfish").superfish("destroy"))}function o(e){var a="genesis-nav",n="mobile-genesis-nav";"none"===l(e)&&(a="mobile-genesis-nav",n="genesis-nav"),$('.genesis-skip-link a[href^="#'+a+'"]').each(function(){var e=$(this).attr("href");e=e.replace(a,n),$(this).attr("href",e)})}function u(e){"none"===l(e)&&($(".menu-toggle, .sub-menu-toggle").removeClass("activated").attr("aria-expanded",!1).attr("aria-pressed",!1),$("nav.nav-primary , .sub-menu").attr("style",""))}function l(a){var n=e.getElementById(a);return window.getComputedStyle(n).getPropertyValue("display")}function d(e,a){e.attr(a,function(e,a){return c(a)})}function c(e){return"false"===e?"true":"false"}var p={},g="menu-toggle",f="sub-menu-toggle";p.init=function(){var e={menu:$("<button />",{class:"menu-toggle","aria-expanded":!1,"aria-pressed":!1,role:"button"}).append(p.params.mainMenu),submenu:$("<button />",{class:f,"aria-expanded":!1,"aria-pressed":!1,role:"button"}).append($("<span />",{class:"screen-reader-text",text:p.params.subMenu}))};$("nav.nav-primary ").before(e.menu),$("nav.nav-primary  .sub-menu").before(e.submenu),$(".menu-toggle").each(n),$(window).on("resize.leaven",t).triggerHandler("resize.leaven"),$(".menu-toggle").on("click.leaven-mainbutton",s),$("."+f).on("click.leaven-subbutton",r)},$(e).ready(function(){p.params="undefined"==typeof LeavenL10n?"":LeavenL10n,void 0!==p.params&&p.init()})}(document,jQuery);