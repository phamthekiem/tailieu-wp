
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
	jQuery(document).ready(function() {
		jQuery('.city').select2();
	});
	var dataFilter;

	jQuery('.city').each(function() {
		var self = jQuery(this);
		self.change(function() {
			var optionSelected = self.select2('data')[0];
			var pId = optionSelected.id;
			jQuery('.city-value').val(optionSelected.text);
			jQuery.ajax({
					method: "GET",
					url: "<?php echo get_template_directory_uri() ?>/lib/quan_huyen.json",
				})
				.done(function(response) {
					var html = '';
					dataFilter = response.filter(function(i) {
						return i.parent_code === pId;
					});
					html += '<option value="">Chọn quận huyện</option>';
					jQuery.each(dataFilter, function(key, value) {
						html += `<option value="${value.name_with_type}">${value.name_with_type}</option>`;
					})
					self.parent().parent().next().find('.districts').html(html);
					self.parent().parent().next().find('.districts').select2();
				});
		})
	})
</script>