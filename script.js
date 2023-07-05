//const btn = document.getElementById("test")//.addEventListener("click", (btn) => {
//document.getElementById("test").style.display = "inline";
//});
// const form = document.getElementById("test1");
//console.log(btn)
//console.log(form)

//const element = document.getElementById("test");
//element.addEventListener("click", () => {
//  const element1 = document.getElementById("test1");
//  element1.style.display = "inline";
// });
//
//function changeOrder() {
//  let list = document.getElementById("todo-item");
//  let elements = list.getElementsByTagName("li");
//  let parents = elements[0].parentNode;
//
//  let elementsArray = Array.prototype.slice.call(elements);
//  elementsArray.reverse();
//
//  while (list.firstChild) {
//    list.removeChild(list.firstChild);
//  }
//  elementsArray.forEach(function (element) {
//    parents.appendChild(element);
//  });
//}
//
//changeOrder("todo-item");

let btn = document.querySelector('.add-btn');
//console.log(btn);

let addInput = document.querySelector('#newTaskInput');
//console.log(addInput);

function getCsrfToken() {
  return document.querySelector('#token').value;
};

function addTask(addInput, btn) {
  const data = {
    action: 'add',
    addInput: addInput,
    btn: btn,
    token: getCsrfToken(),
  }
  return enteringApi('CREATE', data);
}



async function enteringApi(method, data) {
  console.log(enter);

  try {
    const enter = await fetch("add.php", {
      method: method,
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })

    return enter.json();
  }
  catch (error) {
    console.error("forbidden : access denied, please contact your adminsys")
  }
}
