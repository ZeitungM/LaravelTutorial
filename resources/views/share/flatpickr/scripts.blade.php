<script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/ja.js"></script>
<script>
  flatpick(doument.getElementById('due_date'),
    {
       locale: 'ja',
       dateFormat: "Y/m/d",
       minDate: new Date()
    });
</script>

