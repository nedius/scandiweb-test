document.addEventListener('DOMContentLoaded', () => {

    // Delete selected items
    document.querySelector('#delete-product-btn').addEventListener('click', (e) => {
        let products = [];
        document.querySelectorAll('.delete-checkbox').forEach(checkbox => {
            if (checkbox.checked) {
                products.push(checkbox.value);
            }
        });

        if (products.length > 0) {
            fetch('/products/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(products)
            }).then(res =>res.json())
            .then(data => {
                console.log(data);
                if (data.status === 'success') {
                    updateProductList();
                }
            });
        }
    });

    // Go to add product page
    document.querySelector('#add-product-btn').addEventListener('click', (e) => {
        window.location.href = '/add-product';
    });

    // Update product list
    function updateProductList(){
        fetch('/products')
        .then(res => res.json())
        .then(data => {
            document.querySelector('#product-list').innerHTML = '';
            data.forEach(product => {
                document.querySelector('#product-list').appendChild(
                    createProductCard(product)
                );
            });
        });
    }

    function createProductCard(product) {
        // Creating dom elements
        let container = document.createElement('div'),
            card = document.createElement('div'),
            cardBody = document.createElement('div'),
            formCheck = document.createElement('div'),
            input = document.createElement('input'),
            textContainer = document.createElement('div'),
            sku = document.createElement('p'),
            name = document.createElement('p'),
            price = document.createElement('p'),
            type = document.createElement('p');

        // Setting classes
        container.classList.add('col-md-3');
        card.classList.add('card', 'mb-4', 'box-shadow');
        cardBody.classList.add('card-body');
        formCheck.classList.add('form-check');
        input.classList.add('delete-checkbox', 'form-check-input', 'position-static');
        textContainer.classList.add('d-flex', 'flex-column', 'align-items-center');
        sku.classList.add('card-text', 'mb-1');
        name.classList.add('card-text', 'mb-1');
        price.classList.add('card-text', 'mb-1');
        type.classList.add('card-text', 'mb-1');

        // Setting attributes
        input.setAttribute('type', 'checkbox');
        input.setAttribute('value', product.sku);

        // Setting text
        sku.innerText = product.sku;
        name.innerText = product.name;
        price.innerText = product.price;
        type.innerText = getProductTypeDescription(product.type) + ': ' + product.description;

        // Appending elements
        textContainer.appendChild(sku);
        textContainer.appendChild(name);
        textContainer.appendChild(price);
        textContainer.appendChild(type);

        formCheck.appendChild(input);
        cardBody.appendChild(formCheck);
        cardBody.appendChild(textContainer);
        card.appendChild(cardBody);
        container.appendChild(card);

        return container;
    }

    function getProductTypeDescription(type) {
        switch (type) {
            case 'Book':
                return 'Weight';
            case 'Disc':
                return 'Size';
            case 'Furniture':
                return 'Dimensions';

            default:
                return "Description";
        }
    }
});