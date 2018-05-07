var app = new Vue({
    el: '#productApp',
    //contêm as variáveis que serão utilizadas
    data: {
        products: [],
        productToUpdate: {
            id: null,
            index: null,
            name: null
        },
        productToCreate: {
            name: null
        },
        productToSee: {
            id: null,
            name: null,
            created_at: null,
            updated_at: null
        },
        showUpdateContainer: false,
        showInfoContainer: false
    },
    //contêm as funções que interagem com o servidor de API
    methods: {
        createProduct: function() {
            if(!this.productToCreate.name) {
                return;
            }
            this.$http.post('/produtos', this.productToCreate, {responsiveType: 'json'}).then(function(response){
                var data = response.body;
                app.products.push({
                    id: data.id,
                    name: data.name
                });
                app.productToCreate.name = null;
            });
        },
        deleteProduct: function(index) {
            var id = this.products[index].id;
            this.$http.delete('/produtos/' + id, {responsiveType: 'json'}).then(function(response){
                app.products.splice(index, 1);
            });
        },
        findProduct: function(id) {
            this.showUpdateContainer = false;
            this.$http.get('/produtos/' + id, {responsiveType: 'json'}).then(function(response){
                app.productToSee = response.body;
                app.showInfoContainer = true;
            });
        },
        updateProduct: function() {
            this.$http.put('/produtos/' + this.productToUpdate.id, {name: this.productToUpdate.name}, {responsiveType: 'json'}).then(function(response){
                var data = response.body;
                app.$set(app.products, app.productToUpdate.index, {
                    id: data.id,
                    name: data.name
                });
                app.productToUpdate = {
                    index: null,
                    id: null,
                    name: null
                };
                app.showUpdateContainer = false;
            });
        },
        showEdit: function(index) {
            this.productToUpdate.index = index;
            this.productToUpdate.id = this.products[index].id;
            this.productToUpdate.name = this.products[index].name;
            this.showUpdateContainer = true;
            this.showInfoContainer = false;
        },
        closeInfo: function(){
            this.showInfoContainer = false;
        }
    },
    //Vue Lifecycle hook
    created: function() {
        this.$http.get('/produtos', {responsiveType: 'json'}).then(function(response){
            app.products = response.body.map(function(p){
                return {
                    id: p.id,
                    name: p.name
                };
            });
        });
    }
});