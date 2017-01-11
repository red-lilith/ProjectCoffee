$(function () {

  var ProductList = new Ractive({
    el: '.products-list',
    template: '#product_item',
    data: {products: hardcodedProducts}
  });

  var Cart = new Ractive({
    el: '.cart-list',
    template: '#cart_item',
    data: {
      products: hardcodedCartProducts,
      subtotal: 0
    }
  });

  var Categories = new Ractive({
    el: '.categories-list',
    template: '#categories_item',
    data: {categories: hardcodedCategories}
  });

  ProductList.on({
    add: function (event) {

      this.set(event.keypath + '.in_cart', true);

      Cart.push('products', event.context);
    },

    discard: function (event) {

      this.set(event.keypath + '.in_cart', false);

      Cart.get('products').forEach(function (product, index) {
        if (event.context.id === product.id) {
          Cart.splice('products', index, 1);
        }
      });

    }
  });

  Cart.on({
    plus: function (event, index) {
      var quantity = this.get(event.keypath + '.quantity');
      
      if (quantity === 9999) return;
      this.set(event.keypath + '.quantity', ++quantity);
    },
    minus: function (event, index) {
      var quantity = this.get(event.keypath + '.quantity');
      
      if (quantity === 1) return;
      this.set(event.keypath + '.quantity', --quantity);
    },
    discard: function (event, index) {

      ProductList.get('products').forEach(function (product, index) {
        if (event.context.id === product.id) {
          ProductList.set('products.' + index + '.in_cart', false);
        }
      });

      this.splice('products', index, 1);
    }
  });

  Cart.observe('products', function (newValue, oldValue, keypath) {

    var subtotal = 0;

    this.get('products').forEach(function (product, index) {
      subtotal += parseFloat(product.price.replace(',', '.')) * product.quantity;
    });

    this.set('subtotal', (subtotal.toFixed(2)+'').replace('.', ','));
  });

  Categories.on({
    toggle: function (event) {
      if (event.context.active) {
        return;
      }

      this.set('categories.*.active', false);
      this.set(event.keypath + '.active', true);

      ProductList.get('products').forEach(function (product, index) {
        ProductList.set('products.' + index + '.hidden',
          event.context.id !== 1 && event.context.id !== product.category);
      });

    }
  });

});


/**
	POJOS
**/
var hardcodedProducts = [
	{
		id: 1,
		name: 'Product #1',
		image: 'http://lorempixel.com/150/150/food',
		category: 3,
		price: '13,20',
		in_cart: true,
		hidden: false,
     quantity: 1
	},
	{
		id: 4,
		name: 'Product #4',
		image: 'http://lorempixel.com/150/150/food',
		category: 4,
		price: '6,66',
		in_cart: false,
		hidden: false,
     quantity: 1
	},
	{
		id: 6,
		name: 'Product #6',
		image: 'http://lorempixel.com/150/150/food',
		category: 3,
		price: '5,50',
		in_cart: false,
		hidden: false,
     quantity: 1
	},
	{
		id: 8,
		name: 'Product #8',
		image: 'http://lorempixel.com/150/150/food',
		category: 4,
		price: '99,99',
		in_cart: false,
		hidden: false,
     quantity: 1
	},
	{
		id: 10,
		name: 'Product #10',
		image: 'http://lorempixel.com/150/150/food',
		category: 2,
		price: '1,75',
		in_cart: false,
		hidden: false,
     quantity: 1
	},
	{
		id: 7,
		name: 'Product #7',
		image: 'http://lorempixel.com/150/150/food',
		category: 2,
		price: '4,50',
		in_cart: false,
		hidden: false,
     quantity: 1
	},
	{
		id: 9,
		name: 'Product #9',
		image: 'http://lorempixel.com/150/150/food',
		category: 3,
		price: '10,10',
		in_cart: false,
		hidden: false,
     quantity: 1
	},
	{
		id: 2,
		name: 'Product #2',
		image: 'http://lorempixel.com/150/150/food',
		category: 4,
		price: '3,60',
		in_cart: false,
		hidden: false,
     quantity: 1
	}
];

var hardcodedCartProducts = [
	{
		id: 1,
		name: 'Product #1',
		image: 'http://lorempixel.com/150/150/food',
		price: '13,20',
     quantity: 1
	}
];

var hardcodedCategories = [
	{
		id: 1,
		name: "All",
		active: true
	},
	{
		id: 2,
		name: "Breakfast",
		active: false
	},
	{
		id: 3,
		name: "Lunch",
		active: false
	},
	{
		id: 4,
		name: "Dinner",
		active: false
	}
];
