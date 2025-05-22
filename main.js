// Initialize variables
let cart = JSON.parse(localStorage.getItem('cart')) || [];
const listCartHTML = document.querySelector('.listCart');
const iconCartSpan = document.getElementById('cartCount');
const checkOutBtn = document.getElementById('checkOutBtn');

// Toggle cart tab
document.querySelector('.icon-cart').addEventListener('click', () => {
    document.body.classList.toggle('showCart');
});

document.querySelector('.close').addEventListener('click', () => {
    document.body.classList.remove('showCart');
});

// Add to cart functionality
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('addCart')) {
        const button = event.target;
        const id = parseInt(button.getAttribute('data-id'));
        const name = button.getAttribute('data-name');
        const price = parseInt(button.getAttribute('data-price'));
        const stock = parseInt(button.getAttribute('data-stock'));
        
        addToCart(id, name, price, stock);
    }
});

function addToCart(id, name, price, stock) {
    const existingItem = cart.find(item => item.id === id);
    
    if (existingItem) {
        if (existingItem.quantity < stock) {
            existingItem.quantity++;
        } else {
            alert('Stok tidak mencukupi');
            return;
        }
    } else {
        cart.push({
            id: id,
            name: name,
            price: price,
            quantity: 1
        });
    }
    
    updateCart();
    document.body.classList.add('showCart');
}

function updateCart() {
    // Update cart count
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    iconCartSpan.textContent = totalItems;
    
    // Update cart display
    let html = '';
    cart.forEach(item => {
        html += `
        <div class="item" data-id="${item.id}">
            <div class="image">
                <img src="assets/placeholder.jpg" alt="${item.name}">
            </div>
            <div class="name">${item.name}</div>
            <div class="totalPrice">Rp${(item.price * item.quantity).toLocaleString('id-ID')}</div>
            <div class="quantity">
                <span class="minus" data-id="${item.id}"><</span>
                <span>${item.quantity}</span>
                <span class="plus" data-id="${item.id}">></span>
            </div>
        </div>
        `;
    });
    
    listCartHTML.innerHTML = html || '<p>Keranjang kosong</p>';
    
    // Add event listeners to quantity controls
    document.querySelectorAll('.minus').forEach(button => {
        button.addEventListener('click', function() {
            const id = parseInt(this.getAttribute('data-id'));
            changeQuantity(id, 'minus');
        });
    });
    
    document.querySelectorAll('.plus').forEach(button => {
        button.addEventListener('click', function() {
            const id = parseInt(this.getAttribute('data-id'));
            changeQuantity(id, 'plus');
        });
    });
    
    // Save to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));
}

function changeQuantity(id, action) {
    const itemIndex = cart.findIndex(item => item.id === id);
    
    if (itemIndex !== -1) {
        if (action === 'plus') {
            // Check stock before increasing quantity
            const productElement = document.querySelector(`.item[data-id="${id}"] .addCart`);
            const stock = parseInt(productElement.getAttribute('data-stock'));
            
            if (cart[itemIndex].quantity < stock) {
                cart[itemIndex].quantity++;
            } else {
                alert('Stok tidak mencukupi');
                return;
            }
        } else {
            if (cart[itemIndex].quantity > 1) {
                cart[itemIndex].quantity--;
            } else {
                cart.splice(itemIndex, 1);
            }
        }
        updateCart();
    }
}

// Checkout functionality
// checkOutBtn.addEventListener('click', () => {
//     if (cart.length === 0) {
//         alert('Keranjang belanja kosong');
//         return;
//     }
    
//     // Send cart data to server
//     fetch('checkout_process.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({cart: cart})
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             // Redirect to receipt page
//             window.location.href = 'struk.php';
//             // Clear cart
//             cart = [];
//             localStorage.removeItem('cart');
//             updateCart();
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//     });
// });

// Initialize cart on page load
updateCart();