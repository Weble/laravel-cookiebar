export function hasClass(element, cssClass) {
    return element.classList.contains(cssClass);
}

export function addClickTo(selector, cb) {
    const elements = document.querySelectorAll(selector)
    if (elements.length <= 0) {
        return;
    }

    elements.forEach((button) => button.addEventListener("click", cb))
}

export function hide(el) {
    if (! el) {
        return;
    }
    el.style.display = "none";
}

export function show(el) {
    if (! el) {
        return;
    }
    el.style.display = "block";
}



