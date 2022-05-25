document.addEventListener('DOMContentLoaded', () => {

    document.querySelector('#save-btn').addEventListener('click', (e) => {
        // window.location.href = '/';
        let sku = document.querySelector('#sku').value, 
            name = document.querySelector('#name').value,
            price = document.querySelector('#price').value, 
            type = document.querySelector('#productType').value,
            size = document.querySelector('#size').value,
            weight = document.querySelector('#weight').value,
            height = document.querySelector('#height').value,
            width = document.querySelector('#width').value,
            length = document.querySelector('#length').value,
            description = ``;

        if (sku === '' || name === '' || price === '' || type === '') {
            setFormStatus('danger', 'Please fill in all fields');
            return;
        }

        switch (type) {
            case "DVD":
                if(!isNaN(size)){
                    description = `${size} MB`;
                }
                break;
            case "Book":
                if(!isNaN(weight)){
                    description = `${weight} KG`;
                }
                break;
            case "Furniture":
                if(!isNaN(height) && !isNaN(width) && !isNaN(length)){
                    description = `${height}x${width}x${length}`;
                }
                break;
        }

        fetch('/products/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                sku: sku,
                name: name,
                price: price,
                type: type,
                description: description,
            })
        }).then(res => res.json())
        .then(data => {
            console.log(data);
            setFormStatus(data.status, data.message, data.errors);
            if (data.status === 'success') {
                window.location.href = '/';
            }
        });
    });

    document.querySelector('#cancel-btn').addEventListener('click', (e) => {
        window.location.href = '/';
    });

    document.querySelector('#productType').addEventListener('change', (e) => {
        changeType(e.target.value);
    });

    function changeType(type){
        document.querySelectorAll("#typeFormGroup > div").forEach(element => {
            element.style.display = 'none';
        });
        document.querySelector(`#${type}-div`).style.display = 'block';
    }

    function setFormStatus(color, text, errors){
        document.querySelector('#formStatus').classList = `text-${color} mt-3`;
        document.querySelector('#formStatus').innerText = text;

        if(errors){
            document.querySelector('#formErrors').innerHTML = '';
            for(error in errors){
                let li = document.createElement('li'),
                    ul = document.createElement('ul');

                li.innerText = error;
                ul.id = `${error}-error`;

                li.appendChild(ul);
                document.querySelector(`#formErrors`).appendChild(li);

                errors[error].forEach(err => {
                    let li = document.createElement('li');
                    li.innerText = err;
                    document.querySelector(`#${error}-error`).appendChild(li);
                });
            }
        }
    }

    changeType(document.querySelector('#productType').value);
});