

const breeds = document.querySelector('#searchInpValues').querySelectorAll('li')
const breedInp = document.querySelector('#breedInp')

breedInp.addEventListener('input', () => {
   let written = breedInp.value
   breeds.forEach(breed => {
      if (breed.innerText.toLowerCase().includes(written.toLowerCase())) {
         breed.style.display = 'block'
      } else {
         breed.style.display = 'none'

      }
   })

})
breeds.forEach(breed => {
   breed.addEventListener('mouseenter', () => {
      breedInp.value = breed.innerText

   })
})

if (document.activeElement === breedInp) {
   document.querySelector('#searchInpValues').style.display = 'block'

}





const breedsMobile = document.querySelector('#searchInpValuesMobile').querySelectorAll('li')
const breedInpMobile = document.querySelector('#breedInpMobileFr')


function getWidth() {
   return Math.max(
      document.body.scrollWidth,
      document.documentElement.scrollWidth,
      document.body.offsetWidth,
      document.documentElement.offsetWidth,
      document.documentElement.clientWidth
   );
}
console.log(getWidth())

document.querySelector('#breedInpMobile').addEventListener('click', () => {
   if (Math.max(
      document.body.scrollWidth,
      document.documentElement.scrollWidth,
      document.body.offsetWidth,
      document.documentElement.offsetWidth,
      document.documentElement.clientWidth)
      < 768) {
      document.querySelector('.searchOnMobileContainer').style.display = 'block'
   }
})




breedInpMobile.addEventListener('input', () => {
   let written = breedInpMobile.value
   breedsMobile.forEach(breed => {
      if (breed.innerText.toLowerCase().includes(written.toLowerCase())) {
         breed.style.display = 'block'
      } else {
         breed.style.display = 'none'
      }
   })

})
breedsMobile.forEach(breed => {
   breed.addEventListener('click', () => {
      breedInpMobile.value = breed.innerText
   })
})


function closeSearch() {
   document.querySelector('.searchOnMobileContainer').style.display = 'none'
}