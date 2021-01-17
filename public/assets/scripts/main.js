console.log("hellow");

AOS.init({
  once: true
});

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
    slidesToScroll: 2,
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

  validateData = async (name, phone) => {
    if(name.length <= 0 || name.length <= 2) {
      this.popup("length < 0");
      return false;
    } else if (name.length > 30) {
      this.popup("to mutch simbols in name");
      return false;
    }

    if(isNaN(phone)) {
      this.popup("not a number");
      return false;
    } else if (phone.length < 6) {
      this.popup("to shor phone number")
      return false;
    } else if (phone.length > 13) {
      this.popup("to long phone number");
      return false;
    }

    return true;
  }

  popup = (info = "no info") => {
    console.log(info);
    alert(info);
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
      console.log(elements);
      elements.forEach(item => {
        item.remove();
      })
    }
  }
}

const order = new Order();

productOrder.forEach(item => {
  item.addEventListener("submit", async (e) => {
    e.preventDefault();
    console.log(e, e.target);
  
    const fullName = e.target.fullname.value;
    const phoneNumber = e.target.phone.value;

    const product_id = e.target.product_id.value;
    const product_sku = e.target.sku.value;
    const quantity = e.target.quick_order_quantity.value;
  
    order.loader({rootElement : e.target, state : true});
  
    const valid = order.validateData(fullName, phoneNumber);
    valid.then(statement => {
      if(statement) {
        order.addToCart({product_id, product_sku, quantity})
        .then(() => {
          order.registerOrder({name : fullName, phone : phoneNumber})
          .then(res => {
            order.loader({rootElement : e.target, state : false});
            e.target.innerHTML = "<h2>Order is Done</h2>";
          })
          .catch(err => console.log(err));
        })
        .catch(err => console.log(err));
      } else {
        order.loader({rootElement : e.target, state : false});
      }
    });
  })
});