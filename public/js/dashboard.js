$('#exampleModal').on('shown.bs.modal', function (e) {
    var btn = $(e.relatedTarget);
    var url = btn.attr('data-url');
    var modal = $(this);
    modal.find('.modal-body').load(url);
});