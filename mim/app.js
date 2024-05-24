let openShopping = document.querySelector('.shopping');
let closeShopping = document.querySelector('.closeShopping');
let list = document.querySelector('.list');
let listCard = document.querySelector('.listCard');
let body = document.querySelector('body');
let total = document.querySelector('.total');
let quantity = document.querySelector('.quantity');

openShopping.addEventListener('click', ()=>{
    body.classList.add('active');
})
closeShopping.addEventListener('click', ()=>{
    body.classList.remove('active');
})

let products = [
    {
        "id": 1,
        "name": "Green Papaya Salad",
        "price": 9.99,
        "image": "1.jpg",
        "description": "A taste of exotic Asia. Green papaya strings. Mixed with pork, shrimp, peanut and vegetable"
    },
    {
        "id": 2,
        "name": "Lotus Root Salad",
        "price": 9.99,
        "image": "2.jpg",
        "description": "Lotus root mixed with beef, shrimp, herbs."
    },
    {
        "id": 3,
        "name": "Cassava Noodle Mix",
        "price": 9.99,
        "image": "3.jpg",
        "description": "Noodle made of cassava powder. Mixed with pork, shrimp, peanut and vegetable"
    },
    {
        "id": 4,
        "name": "Stewed Pork In Claypot",
        "price": 14.99,
        "image": "4.jpg",
        "description": "Delicacy of authentic cooking way"
    },
    {
        "id": 5,
        "name": "Grilled Fingerlings",
        "price": 14.99,
        "image": "5.jpg",
        "description": "Grilled potatoes with a Western flair served with sauce of choice."
    },
    {
        "id": 6,
        "name": "Asian Pear Salad",
        "price": 14.99,
        "image": "6.jpg",
        "description": "Crisp pears and pecans with tender fries and maple syrup with cheese."
    },
    {
        "id": 7,
        "name": "Roasted Acorn Squash",
        "price": 14.99,
        "image": "7.jpg",
        "description": "Spicy-sweet, soft wedges potatoes which makes a no-fuss holiday special."
    },
    {
        "id": 8,
        "name": "Smothered Chicken",
        "price": 14.99,
        "image": "8.jpg",
        "description": "Grilled chicken breast topped with mushrooms, onions and cheese."
    },
    {
        "id": 9,
        "name": "Spicy Himalayan Diablo",
        "price": 14.99,
        "image": "9.jpg",
        "description": "Chef Devkota's signature dish"
    },
    {
        "id": 10,
        "name": "Mystical Momo Fusion",
        "price": 14.99,
        "image": "10.jpg",
        "description": "Chef Devkota's signature dish"
    },
    {
        "id": 11,
        "name": "Classic Hawaiian Ham/Chicken",
        "price": 9.99,
        "image": "11.jpg",
        "description": "Tomato sauce, mozzarella, pineapple ham or chicken, your choice"
    },
    {
        "id": 12,
        "name": "Carbonaro bacon",
        "price": 9.99,
        "image": "12.jpg",
        "description": "Creamy carbonara sauce, mozzarella and choices of your bacon or smoke chicken"
    },
    {
        "id": 13,
        "name": "Salami Pizza",
        "price": 9.99,
        "image": "13.jpg",
        "description": "Tomato sauce, mozzarella, salami"
    },
    {
        "id": 14,
        "name": "Agliolio",
        "price": 9.99,
        "image": "14.jpg",
        "description": "Light tomato sauce, mozzarella green capers, black olive, chilly flakes, parsley chunks, olive oil"
    },
    {
        "id": 15,
        "name": "Fresh Farm House",
        "price": 9.99,
        "image": "15.jpg",
        "description": "Tomato sauce, mozarella, sliced potato, purple cabbage, bell pepper, onion"
    },
    {
        "id": 16,
        "name": "Four Cheese Pizza",
        "price": 9.99,
        "image": "16.jpg",
        "description": "Mozzarella, kanchan, feta, cheddar"
    },
    {
        "id": 17,
        "name": "Smoke Chicken",
        "price": 9.99,
        "image": "17.jpg",
        "description": "Tomato sauce, mozzarella, smoke chicken"
    },
    {
        "id": 18,
        "name": "Spaghetti Bolognese",
        "price": 9.99,
        "image": "18.jpg",
        "description": "Spaghetti (long strings of pasta) with an Italian ragù (meat sauce) made with minced beef, bacon and tomatoes, served with Parmesan cheese"
    },
    {
        "id": 19,
        "name": "Penne Rocco",
        "price": 9.99,
        "image": "19.jpg",
        "description": "Penne pasta toasted in crispy bacon, cherry tomato, white onion and mint leaves served with garlic bread"
    },
    {
        "id": 20,
        "name": "Penne Arrabbiata",
        "price": 9.99,
        "image": "20.jpg",
        "description": "Creamy white sauce, cheese and chicken fillet served with garlic bread"
    },
    {
        "id": 21,
        "name": "Chicken Sandwich",
        "price": 9.99,
        "image": "21.jpg",
        "description": null
    },
    {
        "id": 22,
        "name": "Egg Sandwich",
        "price": 9.99,
        "image": "22.jpg",
        "description": null
    },
    {
        "id": 23,
        "name": "Club Sandwich",
        "price": 9.99,
        "image": "23.jpg",
        "description": null
    },
    {
        "id": 24,
        "name": "Grilled Cheese Sandwich",
        "price": 9.99,
        "image": "24.jpg",
        "description": null
    },
    {
        "id": 25,
        "name": "Ham Sandwich",
        "price": 9.99,
        "image": "25.jpg",
        "description": null
    },
    {
        "id": 26,
        "name": "Buff Burger",
        "price": 9.99,
        "image": "26.jpg",
        "description": null
    },
    {
        "id": 27,
        "name": "Chicken Burger",
        "price": 9.99,
        "image": "27.jpg",
        "description": null
    },
    {
        "id": 28,
        "name": "Crunchy Chicken Burger",
        "price": 9.99,
        "image": "28.jpg",
        "description": null
    },
    {
        "id": 29,
        "name": "Cheeseburger",
        "price": 9.99,
        "image": "29.jpg",
        "description": null
    }
];
let listCards  = [];
function initApp(){
    products.forEach((value, key) =>{
        let newDiv = document.createElement('div');
        newDiv.classList.add('item');
        newDiv.innerHTML = `
            <img src="mim/${value.image}">
            <div class="title">${value.name}</div>
            <div class="description">${value.description}</div>
            <div class="price">${value.price.toLocaleString()}</div>
            <button onclick="addToCard(${key})">Add To Cart</button>`;
        list.appendChild(newDiv);
    })
}
initApp();
function addToCard(key){
    if(listCards[key] == null){
        // copy product form list to list card
        listCards[key] = JSON.parse(JSON.stringify(products[key]));
        listCards[key].quantity = 1;
    }
    reloadCard();
}
function reloadCard(){
    listCard.innerHTML = '';
    let count = 0;
    let totalPrice = 0;
    listCards.forEach((value, key)=>{
        totalPrice = totalPrice + value.price;
        count = count + value.quantity;
        if(value != null){
            let newDiv = document.createElement('li');
            newDiv.innerHTML = `
                <div>${value.name}</div>
                <div>${value.price.toLocaleString()}</div>
                <div>
                    <button onclick="changeQuantity(${key}, ${value.quantity - 1})">-</button>
                    <div class="count">${value.quantity}</div>
                    <button onclick="changeQuantity(${key}, ${value.quantity + 1})">+</button>
                </div>`;
                listCard.appendChild(newDiv);
        }
    })
    total.innerText =totalPrice.toLocaleString();
    quantity.innerText = count;
}
function changeQuantity(key, quantity){
    if(quantity == 0){
        delete listCards[key];
    }else{
        listCards[key].quantity = quantity;
        listCards[key].price = quantity * products[key].price;
    }
    reloadCard();
}
