class ProductCarts {
    constructor() {
        this.products = ProductCarts.getCookie();//Biến lưu danh sách các sản phẩm cùng với số lượng đã đặt hàng
    }
    get(product_id){//Lấy ra ProductCarts có product_id là product_id
        let productCart = new ProductCart(product_id, 0);
        let i = this.indexOf(productCart);
        if (i !== -1) {
            return this.products[i];
        } else {
            return null;
        }
    }
    add(productCart) {//Thêm productCart vào ProductCarts, nếu ProductCart đã có thì cộng thêm số lượng vào
        let i = this.indexOf(productCart);
        if (i !== -1) {
            productCart.quantity += this.products[i].quantity;
            this.products[i] = productCart;
        } else {
            this.products.push(productCart);
        }
        ProductCarts.saveCookie(this.products);
    }
    set(productCart) {//Thêm productCart vào ProductCarts, nếu ProductCart đã có thì xóa cái cũ đi thêm cái mới vào
        let i = this.indexOf(productCart);
        if (i !== -1) {
            this.products[i] = productCart;
        } else {
            this.products.push(productCart);
        }
        ProductCarts.saveCookie(this.products);
    }
    remove(productCart) {//Xóa 1 ProductCart trong ProductCarts
        let i = this.indexOf(productCart);
        if (i !== -1) {
            this.products.splice(i, 1);
        }
        ProductCarts.saveCookie(this.products);
    }
    indexOf(productCart) {//Tìm vị trí của 1 ProductCart trong ProductCarts
        if (this.products.length == 0 || productCart == null) return -1;
        for (var i = 0; i < this.products.length; i++) {
            if (this.products[i].product_id === productCart.product_id) return i;
        }
        return -1;
    }
    static getCookie() {//Trả về danh sách ProductCarts từ cookie
        let product_from_cookie = Cookies.get('product_cart');
        console.log("Get from cookie: " + product_from_cookie);
        if (typeof product_from_cookie === "undefined") {
            return [];
        }
        product_from_cookie = JSON.parse(product_from_cookie);
        if (product_from_cookie == null) return [];
        else return product_from_cookie;
    }
    static saveCookie(products) {//Lưu danh sách ProductCart vào Cookie
        console.log("Save to cookie: " + products);
        if (products == null || products.length == 0) {
            ProductCarts.deleteCookie();
        } else {
            Cookies.set('product_cart', JSON.stringify(products));
        }
    }
    static deleteCookie() {//Xóa danh sách ProductCart khỏi Cookie
        console.log("remove cookie");
        Cookies.remove('product_cart');
    }
}
class ProductCart {
    constructor(product_id, quantity) {
        if($.isNumeric(product_id)){
            product_id = parseInt(product_id);
            if($.isNumeric(quantity)){
                quantity = parseInt(quantity);
            } else {
                quantity = 0;
            }
            this.product_id = product_id;
            this.quantity = quantity;
        }
    }
}