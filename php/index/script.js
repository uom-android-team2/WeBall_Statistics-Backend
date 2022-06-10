'use script';

const thirdOfColumnInfo = document.querySelectorAll(".thirdfOfColumn");

for (const box of thirdOfColumnInfo) {
    box.addEventListener('mouseover', e => {

        box.classList.add('box-info')


    })

    box.addEventListener('mouseout', e => {
        box.classList.remove('box-info')
    })
}