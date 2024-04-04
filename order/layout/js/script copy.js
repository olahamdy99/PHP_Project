let itemsContainer = document.getElementById("itemsContainer");
const orders = document.querySelectorAll(".orders .order");
// let allTitle = document.getElementById("allTitle");
let itemsUser = [];
let total = 0;
let allTotal = 0;

orders.forEach((order) => {
  order.addEventListener("click", () => {
    let id = order.dataset.id;
    let title = order.dataset.title;
    let price = order.dataset.price;
    let quantity = 1;
    let newOrder = { id: id, title: title, quantity: quantity, price: price };
    order.style.pointerEvents = "none";
    order.style.opacity = "0.5";

    total += parseInt(price);
    document.querySelector(".total").textContent = "EGP " + total.toFixed(2);

    let index = itemsUser.indexOf(order);
    if (index == -1) {
      itemsUser.push(newOrder);
      create_order(order);
    }
    console.log(itemsUser);

    document.getElementById("items").value = JSON.stringify(itemsUser);
  });
});

document.addEventListener("click", (event) => {
  if (event.target.closest(".delete")) {
    // const order = event.target.parentElement.parentElement;
    // let item_id = order.dataset.id;

    // let quantity = order.querySelector("input.quantity");

    // let price = parseFloat(
    //   order.querySelector("input.price").value.split(" ")[1]
    // );

    // order.remove();

    // let item = document.querySelector(`.order[data-id="${item_id}"]`);
    // item.style.pointerEvents = "all";
    // item.style.opacity = "1";

    // for (let i = 0; i < itemsUser.length; i++) {
    //   if (itemsUser[i].id == item_id) {
    //     itemsUser.splice(i, 1);
    //     total -= itemsUser[i].quantity * itemsUser[i].price;
    //     document.querySelector(".total").textContent =
    //       "EGP " + total.toFixed(2);
    //     break;
    //   }
    // }

  } else if (event.target.closest(".plus")) {
    let order = event.target.parentElement.parentElement.parentElement;

    let order_id = order.dataset.id;

    // let quantity = order.querySelector("input.quantity");
    // ++quantity.value;

    // let price = parseFloat(
    //   order.querySelector("input.price").value.split(" ")[1]
    // );


    for (let i = 0; i < itemsUser.length; i++) {
      if (itemsUser[i].id == item_id) {
        total -= itemsUser[i].quantity * itemsUser[i].price;
        document.querySelector(".total").textContent =
          "EGP " + total.toFixed(2);
        break;
      }
    }

    // let total = parseInt(allTitle.textContent) + (quantity.value * price);
    // let total = parseInt(allTitle.textContent) + (quantity.value * price);
    // allTotal += quantity.value * price;


    // console.log(quantity.value);
    // console.log(price);
    // console.log(quantity.value * price);
    // console.log(parseInt(allTitle.textContent) + (quantity.value * price));

    // updateQuantityOrder(order_id, quantity);

    // document.querySelector(".total").textContent += "EGP " + total.toFixed(2);
    // document.getElementById("allTitle") = total.toFixed(2);
    allTitle = parseInt(allTitle.textContent) + (quantity.value * price)

  } else if (event.target.closest(".minus")) {
    let order = event.target.parentElement.parentElement.parentElement;
    let order_id = order.dataset.id;
    let quantityInput = order.querySelector("input.quantity");
    let quantity = parseInt(quantityInput.value);

    if (quantity > 1) {
      --quantity;
      quantityInput.value = quantity;

      let price = parseFloat(order.querySelector("input.price").value.split(" ")[1]);

      total -= quantity * price;

      updateQuantityOrder(order_id, quantity);

      document.querySelector(".total").textContent = "EGP " + total.toFixed(2);
    }

    // let order = event.target.parentElement.parentElement.parentElement;

    // let order_id = order.dataset.id;

    // let quantity = order.querySelector("input.quantity");
    // --quantity.value

    // let price = parseFloat(
    //   order.querySelector("input.price").value.split(" ")[1]
    // );

    // if (quantity.value > 1) {
    //   total = quantity.value * price;

    //   updateQuantityOrder(order_id, quantity.value);

    //   document.querySelector(".total").textContent = "EGP " + total.toFixed(2);
    // }
  }
});


// } else if (event.target.closest(".plus")) {

//   let order = event.target.closest(".order");
//   let order_id = order.dataset.id;
//   let quantityInput = order.querySelector("input.quantity");
//   let quantity = parseInt(quantityInput.value);
//   ++quantity;
//   quantityInput.value = quantity;

//   let price = parseFloat(order.querySelector("input.price").value.split(" ")[1]);

//   let total = quantity * price;

//   updateQuantityOrder(order_id, quantity);

//   document.querySelector(".total").textContent = "EGP " + total.toFixed(2);
// } else if (event.target.closest(".minus")) {
//   let order = event.target.closest(".order");
//   let order_id = order.dataset.id;
//   let quantityInput = order.querySelector("input.quantity");
//   let quantity = parseInt(quantityInput.value);

//   if (quantity > 1) {
//     --quantity;
//     quantityInput.value = quantity;

//     let price = parseFloat(order.querySelector("input.price").value.split(" ")[1]);

//     let total = quantity * price;

//     updateQuantityOrder(order_id, quantity);

//     document.querySelector(".total").textContent = "EGP " + total.toFixed(2);
// }
// }
// });

//? create new order in left form
function create_order(order) {
  let item = document.createElement("div");
  item.className = "item";
  item.setAttribute("data-id", order.dataset.id);

  let title = document.createElement("input");
  title.className = "title";
  title.setAttribute("disabled", "disabled");
  title.setAttribute("value", order.dataset.title);

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

  item.appendChild(title);
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

  document.getElementById("items").value = JSON.stringify(itemsUser);
}

// let select_user_id = document.getElementById("select_user_id");
// select_user_id.addEventListener("change", () => {
//   document.getElementById("user_id").value = select_user_id.value;
// });

// let makeOrderForm = document.getElementById("makeOrderForm");
// let confirmButton = document.getElementById("confirm");

// confirmButton.addEventListener("click", (event) => {
//   if (
//     itemsContainer.innerHTML == "" ||
//     document.getElementById("room").value == -1 ||
//     document.getElementById("user_id").value == -1
//   ) {
//     event.preventDefault();
//     console.log("Order cannot be confirmed because items list is empty.");
//   }
// });
