$((function(e){$("#basic-datatable").DataTable({language:{searchPlaceholder:"Search...",sSearch:""}}),$("#responsive-datatable").DataTable({language:{searchPlaceholder:"Search...",scrollX:"100%",sSearch:""}}),(a=$("#file-datatable").DataTable({buttons:["copy","excel","colvis"],language:{searchPlaceholder:"Recherche...",scrollX:"100%",sSearch:"", buttons: {copy: "copier",excel:"excel",colvis:"colonnes"}}})).buttons().container().appendTo("#file-datatable_wrapper .col-md-6:eq(0)");var a=$("#delete-datatable").DataTable({language:{searchPlaceholder:"Search...",sSearch:""}});$("#delete-datatable tbody").on("click","tr",(function(){$(this).hasClass("selected")?$(this).removeClass("selected"):(a.$("tr.selected").removeClass("selected"),$(this).addClass("selected"))})),$("#button").click((function(){a.row(".selected").remove().draw(!1)})),$("#example3").DataTable({responsive:{details:{display:$.fn.dataTable.Responsive.display.modal({header:function(e){var a=e.data();return"Details for "+a[0]+" "+a[1]}}),renderer:$.fn.dataTable.Responsive.renderer.tableAll({tableClass:"table"})}}}),$("#example2").DataTable({responsive:!0,language:{searchPlaceholder:"Search...",sSearch:"",lengthMenu:"_MENU_ items/page"}}),$(".select2").select2({minimumResultsForSearch:1/0})}));