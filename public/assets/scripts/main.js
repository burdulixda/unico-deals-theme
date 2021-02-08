function changeTopSlider(e) {
  const elementNumber = e.dataset.img;
  
  const allSliderForImgs = document.querySelectorAll(".slider-top__for img");
  const allSliderNavImgs = document.querySelectorAll(".slider-top__nav img");

  allSliderForImgs.forEach(item => {
    item.classList.remove("slider__active");
  });
  allSliderNavImgs.forEach(item => {
    item.classList.remove("slider__active");
  });

  allSliderNavImgs[elementNumber].classList.add("slider__active");  
  allSliderForImgs[elementNumber].classList.add("slider__active");  
}

jQuery(function($) {
  $(".unico-slider__description").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows : false,
    dots : true,
    dotsClass : "slider-description__dots"
  });
  
  $(".unico-slider__products").slick({
    variableWidth : true,
    slidesToScroll: 1,
    arrows : false,
    infinite: false
  });
  
  $(".slider-modal").slick({
    slidesToShow : 1,
    slidesToScroll : 1,
    arrows : false,
    dots : false
  });
  
  // MODAL
  $("body").on("shown.bs.modal", function() {
    $(".slider-modal").slick("setPosition");
  });
})


// CALCULATORS
function calculate(e) {
  const quantity = Number(e.dataset.count);
  const resultDOM = document.querySelectorAll(".calculate__result");


  resultDOM.forEach(item => {
    const currentValue = Number(item.value);
    const newValue = currentValue + quantity;
    item.value = newValue < 1 ? 1 : newValue;
  });

}

// Quick Buy

const productOrder = document.querySelectorAll(".unico-form");
const unicoUrl = unico_global.unicoUrl;
const adminUrl = unico_global.wpAdminUrl;

class Order {
  _url = unicoUrl;
  _wcAjaxUrl = "/?wc-ajax=add_to_cart";
  _wpAdminAjaxUrl = `${adminUrl}admin-ajax.php?action=create_custom_order`;

  addToCart = async ({product_sku = 0, product_id = 0, quantity = 0}) => {
    const _body = {
      method : "POST",
      headers : {
        "content-type" : "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body : `product_sku=${product_sku}&product_id=${product_id}&quantity=${quantity}`
    }

    const res = await fetch(`${this._url}${this._wcAjaxUrl}`, _body);
    return res;
  }

  validateData = async (nameField, phoneField) => {
    const name = nameField.value;
    const phone = phoneField.value;

    if(name.length <= 2 || name.length > 30 || !isNaN(name)) {
      this.popup("სახელი ველი არასწორადაა შევსებული!");
      nameField.dataset.valid = "false";
    } else {
      nameField.dataset.valid = "true";
    }

    if(isNaN(phone) || phone.length < 6 || phone.length > 13) {
      this.popup("ნომრის ველი არასწორადაა შევსებული!");
      phoneField.dataset.valid = "false";
    } else {
      phoneField.dataset.valid = "true";
    }

    console.log(nameField.dataset.valid === "true", phoneField.dataset.valid === "true")

    if(nameField.dataset.valid === "true" && phoneField.dataset.valid === "true") {
      return true;
    } else {
      return false;
    }
  }

  popup = (value, duplicates = false) => {
    toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": true,
      "progressBar": true,
      "positionClass": "toast-bottom-right",
      "preventDuplicates": duplicates,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "1000",
      "timeOut": "5000",
      "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
    
    toastr["error"](value);
    
  }

  registerOrder = async ({name = "no name", phone = "no phone"}) => {
    const _body = {
      method : "POST",
      headers : {
        "content-type" : "application/x-www-form-urlencoded; charset=UTF-8"
      },
      body : `fullname=${name}&phone=${phone}`
    }

    const res = fetch(`${this._wpAdminAjaxUrl}`, _body);
    return await res;
  }

  loader = ({rootElement = undefined, state = false}) => {
    if(state) {
      rootElement.innerHTML += `
      <div class="my-loader__container">
        <div class="my-loader"></div>
      </div>
      `;
    } else {
      const elements = document.querySelectorAll(".my-loader__container");
      elements.forEach(item => {
        item.remove();
      })
    }
  }
}

const order = new Order();

productOrder.forEach(item => {
  item.addEventListener("submit", (e) => {
    e.preventDefault();
  
    const fullName = e.target.fullname;
    const phoneNumber = e.target.phone;

    const product_id = e.target.product_id.value;
    const product_sku = e.target.sku.value;
    const quantity = e.target.quick_order_quantity.value;
  
    order.loader({rootElement : e.target, state : true});
  
    const valid = order.validateData(fullName, phoneNumber);
    valid.then(statement => {
      if(statement) {
        item.parentNode.classList.remove("unico-error__wrapper");
        order.addToCart({product_id, product_sku, quantity})
        .then(() => {
          order.registerOrder({name : fullName.value, phone : phoneNumber.value})
          .then(res => {
            order.loader({rootElement : e.target, state : false});
            e.target.innerHTML = `
              <div class="unico-description__container animate__animated animate__fadeInRight mt-5" style="background-color : var(--unico-red)">
                <h2 class="w-100 text-center text-light">თქვენი შეკვეთა გადაცემულია !</h2>
                <span class="w-100 text-center text-light my-3">ჩვენი ოპერატორი მალე დაგიკავშირდებათ შემდეგ ნომერზე</span>
                <h3 class="w-100 text-center text-light">${phoneNumber.value}</h3>
              </div>
            `;
          })
          .catch(err => console.log(err));
        })
        .catch(err => console.log(err));
      } else {
        order.loader({rootElement : e.target, state : false});
        item.parentNode.classList.add("unico-error__wrapper");
      }
    });
  })
});

// COUNTDOWN
const countdownDays = document.querySelectorAll(".countdown__days");
const countdownHours =  document.querySelectorAll(".countdown__hours");
const countdownMinutes = document.querySelectorAll(".countdown__minutes");
const countdownSeconds = document.querySelectorAll(".countdown__seconds");

const countdownExpires = document.querySelectorAll(".countdown__expire");

countdownExpires.forEach((item, index) => {
  const endTime = new Date(item.innerText).getTime();

  setInterval(function () {
    let now = new Date().getTime();
    let newDate = endTime - now;

    let days = newDate > 0 ? Math.floor(newDate / (1000 * 60 * 60 * 25)) : 0;
    let hours = newDate > 0 ? Math.floor((newDate % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)) : 0;
    let minutes = newDate > 0 ? Math.floor((newDate % (1000 * 60 * 60)) / (1000 * 60)) : 0;
    let seconds = newDate > 0 ? Math.floor((newDate % (1000 * 60)) / 1000) : 0;

    countdownDays[index].innerText = days;
    countdownHours[index].innerText = hours;
    countdownMinutes[index].innerText = minutes;
    countdownSeconds[index].innerText = seconds;


  }, 1000);

});

function uploadImage() {
  const uploadButton = document.querySelector("#attachment");
  uploadButton.click();
}

const dependedCicleContainer = document.querySelector("#depended_circle_count");
const undependedCicleContainer = document.querySelector(".circle__count");

if(dependedCicleContainer) {
  dependedCicleContainer.innerText = undependedCicleContainer.innerText;
}

// ATTRIBUTE ACCORDION
const attributeItems = document.querySelectorAll(".attribute__item");

if(attributeItems.length > 0) {
  for(let i = 0; i < attributeItems.length; i++) {
    attributeItems[i].classList.add("d-flex");
    if(i > 5) {
      attributeItems[i].classList.remove("d-flex");
      attributeItems[i].classList.add("d-none");
    }
  }
}

const attributeToggle = document.querySelector(".attributes-toggle");

if(attributeToggle) {
  attributeToggle.onclick = (e) => {
    attributeItems.forEach(item => {
      item.classList.add("d-flex");
    });
  
    e.target.remove();
  }
}



class Butaforia {

  setStorage = (num) => {
    localStorage.setItem("itemsCount", num);
  }
  
  getStorage = () => {
    const itemsCount = localStorage.getItem("itemsCount");
    return itemsCount;
  }

  render = (el) => {
    let currentStorage = this.getStorage();

    if(currentStorage < 4 || isNaN(currentStorage) || currentStorage === undefined) {
      this.setStorage(14);
    }

    let currentCount = this.getStorage();
    this.draw(el, currentCount);

    const interval = setInterval(() => {
      if(currentCount <= 3) {
        clearInterval(interval);
        localStorage.clear();
      }
      this.draw(el, currentCount);
      this.setStorage(currentCount--);
    }, (~~(Math.random() * 20) + 15) * 1000);

  }

  draw = (el, value) => {
    if(el.length > 0) {
      for(let i = 0; i < el.length; i++) {
        el[i].innerText = value;
        el[i].parentNode.classList.add("animation-for__circle");
        const elAnimation = setTimeout(() => {
          el[i].parentNode.classList.remove("animation-for__circle");
          clearInterval(elAnimation);
        }, 2000);

      }
    }
  }
}

const butaforia = new Butaforia();
const circleCount = document.querySelectorAll(".circle__count");
const hurryupCount = document.querySelector(".unico-hurryup__text > span");

butaforia.render([...circleCount, hurryupCount]);


const priceOld = document.querySelector(".price del");
const priceNew = document.querySelector(".price ins");

const pricesArr = [priceOld, priceNew];

if(pricesArr.length > 0 && pricesArr[0] !== null && pricesArr[1] !== null) {
  const priceNumbersArr = [];

  pricesArr.forEach(item => {
    const priceNumber = Number(item.innerText.replace(/[^0-9.-]+/g,""));
    priceNumbersArr.push(priceNumber);
  })

  const calculatePercent = Math.ceil(((priceNumbersArr[0] - priceNumbersArr[1]) / priceNumbersArr[0])* 100);

  const percentSale = document.querySelector(".sale__title--subtitle");
  
  percentSale.innerText = `დაზოგე ${calculatePercent}%`;
}

const unicoSubmitButton = document.querySelectorAll(".unico-button__red");

if(unicoSubmitButton.length > 0) {
  setInterval(() => {
    unicoSubmitButton.forEach(item => {
      item.classList.add("unico-submit__animation");
    
      const animationInterval = setTimeout(() => {
        item.classList.remove("unico-submit__animation");
        clearInterval(animationInterval);
      }, 2000);
    })
  }, 4000)
}