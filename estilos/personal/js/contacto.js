
// ---------------TABLA INFORMATIVA DE CONTACTO---------------------------

// Get all button element
let tabButton = document.querySelectorAll('.tabLinks');
let tabContent = document.querySelectorAll('.tabContent');

window.onload = () => {
  document.getElementById('defaultOpen').click();
}

// Hide content function
const hideContent = () => {
  tabContent.forEach(content => {
    content.style.display = "none"
  });
}

tabButton.forEach(tab => {
  tab.addEventListener('click', () => {
    const contentClass = `${tab.classList[1]}Content`;
    hideContent();
    document.querySelector(`.${contentClass}`).style.display = "block"
  })
});


//--------------------ACORDION DE INFORMACIOM-------------------------------



const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

accordionItemHeaders.forEach(accordionItemHeader => {
  accordionItemHeader.addEventListener("click", event => {
    
    // Uncomment in case you only want to allow for the display of only one collapsed item at a time!
    
    // const currentlyActiveAccordionItemHeader = document.querySelector(".accordion-item-header.active");
    // if(currentlyActiveAccordionItemHeader && currentlyActiveAccordionItemHeader!==accordionItemHeader) {
    //   currentlyActiveAccordionItemHeader.classList.toggle("active");
    //   currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
    // }

    accordionItemHeader.classList.toggle("active");
    const accordionItemBody = accordionItemHeader.nextElementSibling;
    if(accordionItemHeader.classList.contains("active")) {
      accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
    }
    else {
      accordionItemBody.style.maxHeight = 0;
    }
    
  });
});

