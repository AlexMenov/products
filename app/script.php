<script>

    //отправка данных, чтобы скрыть товар
    const product_cards = document.getElementsByClassName('hidden');
    const url = "../app/hide_element.php";

    function hiding(item) {
        item.addEventListener(('click'), async (e) => {
            const id = item.id;
            const t = e.target;
            const data = {'hidden_id': id};
            const options = {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            };
            if (t.classList.contains('product-link')) {
                await fetch(url, options)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data);
                    })
                    .catch(error => {
                        console.error(error);
                    });
                item.style.opacity = '0';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 200)

            }
        })
    };

    for (const card of product_cards) {
        hiding(card);
    }
    ;

    //позволяет показать товары в заданном диапазоне
    const productForm = document.getElementById('productForm');
    const perPageInput = document.getElementById('perPage');
    const fromInput = document.getElementById('from');
    const toInput = document.getElementById('to');

    productForm.addEventListener('submit', () => {
        const perPage = perPageInput.value;
        const from = fromInput.value;
        const to = toInput.value;
        const url = `get_products.php?from=${from}&to=${to}`;
        window.location.href = url;
    });

    //счетчик количества
    const action_change = document.getElementsByClassName('product-quantity');
    const action_quantity = document.getElementsByClassName('product-card');

    function changeQuantity(action, change_element) {
        action.addEventListener("click", (e) => {
            const action_change = e.target.textContent;
            let element = parseInt(change_element.textContent.match(/^\d+/)[0]);
            change_element.innerHTML = (action_change === '+' ? ++element : --element) + " шт.";
            ;
        })
    };

    for (let i = 0; i < action_quantity.length; i++) {
        changeQuantity(action_quantity[i], action_change[i]);
    }
    ;


</script>
