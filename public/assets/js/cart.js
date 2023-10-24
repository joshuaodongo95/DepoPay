// Define a Shopping Cart object
class ShoppingCart {
    constructor() {
        this.cart = [];
        this.loadCart();
    }

    // Save cart to local storage
    saveCart() {
        localStorage.setItem('shoppingCart', JSON.stringify(this.cart));
    }

    // Load cart from local storage
    loadCart() {
        const storedCart = JSON.parse(localStorage.getItem('shoppingCart'));
        this.cart = storedCart || [];
    }

    // Add an item to the cart
    addItemToCart(name, price, count) {
        const existingItem = this.cart.find(item => item.name === name);
        if (existingItem) {
            existingItem.count += count;
        } else {
            this.cart.push({ name, price, count });
        }
        this.saveCart();
    }

    // Set the count for a specific item in the cart
    setCountForItem(name, count) {
        const item = this.cart.find(item => item.name === name);
        if (item) {
            item.count = count;
            this.saveCart();
        }
    }

    // Remove a single item from the cart
    removeItemFromCart(name) {
        const itemIndex = this.cart.findIndex(item => item.name === name);
        if (itemIndex !== -1) {
            const item = this.cart[itemIndex];
            item.count -= 1;
            if (item.count === 0) {
                this.cart.splice(itemIndex, 1);
            }
            this.saveCart();
        }
    }

    // Remove all items of a specific name from the cart
    removeItemFromCartAll(name) {
        this.cart = this.cart.filter(item => item.name !== name);
        this.saveCart();
    }

    // Clear the entire cart
    clearCart() {
        this.cart = [];
        this.saveCart();
    }

    // Calculate the total count of items in the cart
    totalCount() {
        return this.cart.reduce((total, item) => total + item.count, 0);
    }

    // Calculate the total cost of items in the cart
    totalCart() {
        return this.cart.reduce((total, item) => total + item.price * item.count, 0).toFixed(2);
    }

    // Get a copy of the cart
    listCart() {
        return this.cart.map(item => ({
            name: item.name,
            price: item.price,
            count: item.count,
            total: (item.price * item.count).toFixed(2),
        }));
    }
}

const shoppingCart = new ShoppingCart();

// Add an item to the cart when a button with the class 'default-btn' is clicked
$('.default-btn').click(function (event) {
    event.preventDefault();
    const name = $(this).data('name');
    const price = Number($(this).data('price'));
    shoppingCart.addItemToCart(name, price, 1);
    displayCart();
});

// Clear the cart when a button with the class 'clear-cart' is clicked
$('.clear-cart').click(function () {
    shoppingCart.clearCart();
    displayCart();
});

// Display the cart
function displayCart() {
    const cartArray = shoppingCart.listCart();
    let output = "";
    for (const item of cartArray) {
        output += `<tr>
            <td>${item.name}</td>
            <td>(${item.price})</td>
            <td><div class='input-group'>
                <input type='number' class='item-count form-control' data-name='${item.name}' value='${item.count}'>
            </div></td>
            <td><button class='delete-item btn btn-danger' data-name='${item.name}'>X</button></td> = 
            <td>${item.total}</td>
            </tr>`;
    }
    $('.show-cart').html(output);
    $('.total-cart').html(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
}

// Delete item button
$('.show-cart').on("click", ".delete-item", function (event) {
    const name = $(this).data('name');
    shoppingCart.removeItemFromCartAll(name);
    displayCart();
});

// Item count input
$('.show-cart').on("change", ".item-count", function (event) {
    const name = $(this).data('name');
    const count = Number($(this).val());
    shoppingCart.setCountForItem(name, count);
    displayCart();
});

// Display the cart on page load
displayCart();

// Rest of the code

// Tabs Single Page
$('.tab ul.tabs').addClass('active').find('> li:eq(0)').addClass('current');
$('.tab ul.tabs li a').on('click', function (event) {
    const tab = $(this).closest('.tab');
    const index = $(this).closest('li').index();
    tab.find('ul.tabs > li').removeClass('current');
    $(this).closest('li').addClass('current');
    tab.find('.tab_content').find('div.tabs_item').not('div.tabs_item:eq(' + index + ')').slideUp();
    tab.find('.tab_content').find('div.tabs_item:eq(' + index + ')').slideDown();
    event.preventDefault();
});

// Search function
$('#search_field').on('keyup', function () {
    const value = $(this).val();
    const patt = new RegExp(value, "i");

    const notFoundElement = document.getElementById('not_found');

    $('.tab_content').find('.col-lg-3').each(function () {
        const $table = $(this);
        const featuredItem = $table.find('.featured-item').text();

        if (featuredItem.search(patt) < 0) {
            $table.not('.featured-item').hide();
        }
        if (featuredItem.search(patt) >= 0) {
            $(this).show();
            notFoundElement.style.display = 'none';
        } else {
            notFoundElement.innerHTML = " Product not found..";
            notFoundElement.style.display = 'block';
        }
    });
});
