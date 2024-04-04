let itemsContainer = document.getElementById("itemsContainer");
const orders = document.querySelectorAll(".orders .order");

let itemsUser = [];
let total = 0;

orders.forEach((order) => {
  order.addEventListener("click", () => {
    let id = order.dataset.id;
    let name = order.dataset.name;
    let price = order.dataset.price;
    let quantity = 1;

    let newOrder = { id: id, product: name, quantity: quantity, price: price };
    order.style.pointerEvents = "none";
    order.style.opacity = "0.5";

    let index = itemsUser.indexOf(order);
    if (index == -1) {
      itemsUser.push(newOrder);
      create_order(order);
    }

    totalPrice(itemsUser);
    document.getElementById("items").value = JSON.stringify(itemsUser);
  });
});

document.addEventListener("click", (event) => {
  if (event.target.closest(".delete")) {
    const order = event.target.parentElement.parentElement;
    let item_id = order.dataset.id;

    let item = document.querySelector(`.order[data-id="${item_id}"]`);
    item.style.pointerEvents = "all";
    item.style.opacity = "1";

    order.remove();

    for (let i = 0; i < itemsUser.length; i++) {
      if (itemsUser[i].id == item_id) {
        itemsUser.splice(i, 1);

        let allTitlePrice = 0;
        for (let i = 0; i < itemsUser.length; i++) {
          allTitlePrice += itemsUser[i].quantity * itemsUser[i].price
        }
        allTitle.innerHTML = allTitlePrice;

        break;
      }
    }

    totalPrice(itemsUser);

  } else if (event.target.closest(".plus")) {
    let order = event.target.parentElement.parentElement.parentElement;
    let order_id = order.dataset.id;
    let quantityInput = order.querySelector("input.quantity");
    let quantity = parseInt(++quantityInput.value);
    quantityInput.value = quantity;

    updateQuantityOrder(order_id, quantity);

  } else if (event.target.closest(".minus")) {
    let order = event.target.parentElement.parentElement.parentElement;
    let order_id = order.dataset.id;
    let quantityInput = order.querySelector("input.quantity");
    let quantity = parseInt(quantityInput.value);

    if (quantity > 1) {
      --quantity;
      quantityInput.value = quantity;
      updateQuantityOrder(order_id, quantity);
    }
  }
});

//? create new order in left form
function create_order(order) {
  let item = document.createElement("div");
  item.className = "item";
  item.setAttribute("data-id", order.dataset.id);
  item.setAttribute("data-name", order.dataset.name);

  let name = document.createElement("input");
  name.className = "name";
  name.setAttribute("disabled", "disabled");
  name.setAttribute("value", order.dataset.name);

  let quantity = document.createElement("div");
  quantity.className = "quantity";

  let quantity_order = document.createElement("input");
  quantity_order.className = "quantity";
  quantity_order.setAttribute("value", 1);
  quantity.appendChild(quantity_order);

  let btns = document.createElement("div");
  btns.className = "btns";

  let plus = document.createElement("span");
  plus.className = "plus btnActive";
  plus.innerHTML = "+";

  let minus = document.createElement("span");
  minus.className = "minus btnActive";
  minus.innerHTML = "-";

  btns.appendChild(plus);
  btns.appendChild(minus);
  quantity.appendChild(btns);

  let price = document.createElement("input");
  price.className = "price";
  price.setAttribute("value", "EGP " + order.dataset.price);

  let action = document.createElement("div");
  action.className = "delete";

  let span = document.createElement("span");
  span.className = "btnActive";
  span.innerHTML = "x";
  action.appendChild(span);

  item.appendChild(name);
  item.appendChild(quantity);
  item.appendChild(price);
  item.appendChild(action);

  itemsContainer.append(item);
}

function updateQuantityOrder(order_id, quantity) {
  for (let i = 0; i < itemsUser.length; i++) {
    if (itemsUser[i].id == order_id) {
      itemsUser[i].quantity = quantity;
      break;
    }
  }

  totalPrice(itemsUser);

  document.getElementById("items").value = JSON.stringify(itemsUser);
}

function totalPrice(itemsUser) {
  let allTitle = document.getElementById("allTitle");

  let allTitlePrice = 0;
  for (let i = 0; i < itemsUser.length; i++) {
    allTitlePrice += itemsUser[i].quantity * itemsUser[i].price
  }
  allTitle.innerHTML = allTitlePrice;
}

let select_user_id = document.getElementById("select_user_id");
select_user_id.addEventListener("change", () => {
  document.getElementById("user_id").value = select_user_id.value;
});

let makeOrderForm = document.getElementById("makeOrderForm");
let confirmButton = document.getElementById("confirm");

confirmButton.addEventListener("click", (event) => {

  if (itemsContainer.innerHTML == "") {
    document.getElementById('error_items').innerHTML = 'error message';
  }

  if (document.getElementById("select_user_id").value == -1) {
    document.getElementById('error_user').innerHTML = 'error message';
  }

  if (document.getElementById("room").value == -1) {
    document.getElementById('error_room').innerHTML = 'error message';
  }

  if (
    itemsContainer.innerHTML == "" ||
    document.getElementById("room").value == -1 ||
    document.getElementById("select_user_id").value == -1
  ) {
    event.preventDefault();
    console.log("Order cannot be confirmed because items list is empty.");
  }
});


