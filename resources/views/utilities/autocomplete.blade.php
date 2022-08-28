<script>
    $(function() {
        $('#search').on('input', function() {
            if ($('#search').val().length) {
                $.ajax({
                    type: "GET",
                    url: "/utilities/autocomplete",
                    data: {
                        search: $('#search').val(),
                        token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.product.length || response.category.length ||
                            response
                            .shop.length) {} else {
                            response.product = {
                                label: `Produk "${$('#search').val()}" Tidak Ada`
                            }
                            response.category = {
                                label: `Kategori "${$('#search').val()}" Tidak Ada`
                            }
                            response.shop = {
                                label: `Toko "${$('#search').val()}" Tidak Ada`
                            }

                        }
                        $("#search").autocomplete({
                            delay: 250,
                            appendTo: ".navbar",
                            source: [].concat(response.category, response.shop,
                                response.product),

                        });
                    }
                });
            }
        });

    });
</script>
