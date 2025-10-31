<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var el = document.getElementById('sortable-tbody');
        Sortable.create(el, {
            animation: 150,
            onStart: function (evt) {
                evt.item.classList.add('dragging'); // Add class when drag starts
            },
            onEnd: function (evt) {
                evt.item.classList.remove('dragging'); // Remove class when drag ends

                var order = [];
                el.querySelectorAll('tr').forEach(function (row) {
                    order.push(row.getAttribute('data-id'));
                });

                fetch("{{ route('admin.contact_us_cards.reorder') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ order: order })
                }).then(response => response.json())
                    .then(data => {
                        console.log(data.message);
                    }).catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    });
</script>

<style>
    #sortable-tbody tr {
        cursor: grab;
        /* Cursor looks like grabbing hand */
    }

    #sortable-tbody tr.dragging,
    .sortable-chosen,
    .sortable-drag {
        cursor: grabbing !important;
        /* Cursor while dragging */
    }
</style>