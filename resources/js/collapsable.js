document.addEventListener("DOMContentLoaded", function () {
    const collapsibles = document.querySelectorAll('.collapsible');
    collapsibles.forEach(collapsible => {
        collapsible.addEventListener('click', function () {
            this.classList.toggle('active');
            const content = this.nextElementSibling;
            content.classList.toggle('hidden');
            const arrow = this.querySelector('.arrow');
            arrow.classList.toggle('fa-angle-up');
            arrow.classList.toggle('fa-angle-down');
            const collapsibleTitle = this.querySelector('.collapsible-title');
            collapsibleTitle.classList.toggle('border-b-2');
            collapsibleTitle.classList.toggle('border-white');
            collapsibleTitle.classList.toggle('border-solid');
            collapsibles.forEach(sibling => {
                if (sibling !== this) {
                    sibling.classList.remove('active');
                    const siblingContent = sibling.nextElementSibling;
                    siblingContent.classList.add('hidden');
                    const siblingArrow = sibling.querySelector('.arrow');
                    siblingArrow.classList.remove('fa-angle-up');
                    siblingArrow.classList.add('fa-angle-down');
                    const siblingCollapsibleTitle = sibling.querySelector('.collapsible-title');
                    siblingCollapsibleTitle.classList.remove('border-b-2');
                    siblingCollapsibleTitle.classList.remove('border-white');
                    siblingCollapsibleTitle.classList.remove('border-solid');
                }
            });
        });
    });
});
