

    /*--------------------------------- WISHLIST --------------------------------------------------------------*/

    var wishitems = Backbone.Model.extend({
        defaults: {
            wishlistID: '',
            itemID: '',
            title: '',
            URL: '',
            priority: ''
        }
    });

/*--------------------------------- RENDER ONE ITEM TO WISHLIST --------------------------------------------------------------*/

var items = Backbone.Collection.extend({
    url:'http://localhost:8888/ASScw2/rest/item/',
    comparator:'priority'
});

var wishlist = new items();

var itemView =  Backbone.View.extend({
    model: new wishitems(),
    tagName: 'tr',
    initialize: function(){
        this.template = _.template($('.item-list-template').html());
    },
    events:{
        'click .edit-item': 'edit',
        'click .save-item': 'save',
        'click .delete-item': 'delete',
        'click .cancel': 'cancel'
    },

    cancel: function(){
        itemsView.render();
    },

/*--------------------------------- DELETE ITEM IN WISHLIST --------------------------------------------------------------*/

    delete: function() {
        Backbone.Model.prototype.idAttribute = 'itemID';
        this.model.destroy({
            success: function(response) {
                console.log('Successfully DELETED wish list item with _id: ' + response.toJSON().item_id);
            },
            error: function() {
                console.log('Failed to delete item!');
            }
        });
    },

/*--------------------------------- EDIT ITEM IN WISHLIST --------------------------------------------------------------*/

    edit: function(){
        $('.edit-item').hide();
        $('.delete-item').hide();
        this.$('.save-item').show();
        this.$('.cancel').show();

        var title = this.$('.title').html();
        var URL = this.$('.URL').html();
        var priority = this.$('.priority').html();

        this.$('.title').html('<input type="text" class="form-control title-edit" value="' + title + '">');
        this.$('.URL').html('<input type="text" class="form-control URL-edit" value="' + URL + '">');
        this.$('.priority').html(' <select class="form-control" id="priority-edit"> <option value="1">Must-Have</option> <option value="2">Would be Nice to Have</option> <option value="3">If You Can</option> </select>');
    },

/*--------------------------------- SAVE ITEM TO WISHLIST --------------------------------------------------------------*/

    save: function(){

        if($('.title-edit').val() == ''){
            alert("Title is Empty");
        }
        else if($('.URL-edit').val() == ''){
            alert("URL is Empty");
        }else{
            this.model.set('title',$('.title-edit').val());
            this.model.set('URL',$('.URL-edit').val());
            this.model.set('priority',$('#priority-edit').val());
            this.model.set('itemID', this.$('.itemID').html());
            this.model.save(null, {
                type: 'PUT',
                success: function(response) {
                    wishlist.fetch();
                    console.log('Successfully UPDATED wishlist with _id: ' + response.toJSON().itemID);
                },
                error: function(err) {
                    console.log('Failed to update item from wishlist!');
                }
            });
        }
    },

/*--------------------------------- RENDER TO WISHLIST --------------------------------------------------------------*/

    render: function(){
        if(this.model.get('priority') == 1){
            this.model.set('priority', 'Must-Have');
        }else if(this.model.get('priority') == 2){
            this.model.set('priority', 'Would be Nice to Have');
        }else if(this.model.get('priority') == 3)
        {
            this.model.set('priority', 'If You Can');
        }
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});


/*--------------------------------- SHARE WISHLIST --------------------------------------------------------------*/


var sharelist = Backbone.Model.extend({
    defaults: {
        itemID: '',
        title: '',
        url: '',
        priority: '',
    }
});

var wishlistID = $('.wishlistID').html();

var sharelistCollection = Backbone.Collection.extend({
    url: 'http://localhost:8888/ASScw2/rest/share/'+wishlistID
});

var sharecollection = new sharelistCollection();

var shareWishListItem = Backbone.View.extend({
    model: new sharelist(),
    tagName: 'tr',
    initialize: function () {
        this.template = _.template($('.share-list-template').html());
    },
    events: {

    },
    render: function () {
        this.$el.html(this.template(this.model.toJSON()));
        return this;
    }
});

var shareWishListItemsAll = Backbone.View.extend({
    model: sharecollection,
    el: $('.share-wishlist'),

    initialize: function() {
        var here = this;
        this.model.on('add', this.render, this);
        this.model.fetch({
            success: function(response) {
                _.each(response.toJSON(), function(shareWishListItem) {
                    console.log('Successfull GET, wishlist item with id: ' + shareWishListItem.itemID);
                })
            },
            error: function(err, args) {
                console.log('Failed GET, wishlist!');
                console.log(err);
                console.log(args);
            }
        });
    },
    render: function() {
        var here = this;
        this.$el.html('');
        _.each(this.model.toArray(), function(wishItem) {
            if(wishItem.get('priority') == 1){
                wishItem.set('priority', 'Must-Have');
            }else if(wishItem.get('priority') == 2){
                wishItem.set('priority', 'Would be Nice to Have');
            }else if(wishItem.get('priority') == 3)
            {
                wishItem.set('priority', 'If You Can');
            }
            here.$el.append((new shareWishListItem({model: wishItem})).render().$el);
        });
        return this;
    }
});
var sharedList = new shareWishListItemsAll();

/*--------------------------------- VIEW ALL ITEMS IN WISHLIST --------------------------------------------------------------*/

var itemsView = Backbone.View.extend({
    model: wishlist,
    el: $('.wishlist-items'),
    initialize: function () {
        var self = this;
        this.model.on('add', this.render, this);
        this.model.on('change', function () {
            setTimeout( function () {
                self.render();
            }, 30)
        }, this);
        this.model.on('remove', this.render, this);
        this.model.fetch({
            success: function(response) {
                _.each(response.toJSON(), function(wishListItem) {
                    console.log('Successfull GET, Item_id: ' + wishListItem.itemID);
                })
            },
            error: function(err, args) {
                console.log('WISHLIST GET FAILED');
                console.log(err);
                console.log(args);
            }
        });
    },
    render: function () {
        var self = this;
        this.$el.html('');
        _.each(this.model.toArray(), function (lst) {
            self.$el.append((new itemView({model: lst})).render().$el);
        });
        return this;
    }
});

var itemsView = new itemsView();



function validation(){
    if($('.title').val() == ''){
        swal ( "Warning" ,  "You cannot leave Title empty!" ,  "warning" );
        return false;
    }
    else if($('.URL').val() == ''){
        swal ( "Warning" ,  "You cannot leave URL empty!" ,  "warning" );
        return false;
    }else{
        return true;
    }
}

/*--------------------------------- EVENT BINDINGS --------------------------------------------------------------*/

$(document).ready(function() {



/*--------------------------------- ADD ITEM TO WISHLIST --------------------------------------------------------------*/
    $('.add-item').on('click', function() {

        if(validation()){
            var item = new wishitems({
                title: $('.title').val(),
                URL: $('.URL').val(),
                priority: $('#priority-add').val(),
                wishlistID: 1
            });
            $('.title').val('');
            $('.URL').val('');
            $('.priority').val('');
            wishlist.add(item);

            wishlist.each(function(wishitems) {
                if(wishitems.get('priority') == 'Must-Have'){
                    wishitems.set('priority', 1);
                }else if(wishitems.get('priority') == 'Would be Nice to Have'){
                    wishitems.set('priority', 2);
                }else if(wishitems.get('priority') == 'If You Can')
                {
                    wishitems.set('priority', 3);
                }
                console.log(wishitems.get('priority'));
            });

            //-- save the items into the database
            item.save(null, {
                success: function(response) {
                    wishlist.fetch();
                    console.log('Successfully SAVED, itemID: ' + response.toJSON().itemID);
                },
                error: function(err) {
                    console.log('SAVE FAILED '+ err);
                }
            });
            console.log(wishlist.toJSON());
        }


    });


/*--------------------------------- USER LOGIN --------------------------------------------------------------*/

    var user = Backbone.Model.extend({
        defaults: {
            username: '',
            password: ''
        }
    });

    var login = Backbone.Model.extend({
        url:'http://localhost:8888/ASScw2/rest/userdetail/'
    });

    $('.userlogin').on('click', function() {

        var loginUser = new login();
        var loginCredentials= {
            username:$('.username').val(),
            password:$('.password').val()
        };
        console.log(loginCredentials);
        loginUser.save(loginCredentials, {
                success: function(response){
                    console.log(response);
                    //swal ( "success" ,  "You cannot leave Title empty!" ,  "success" );
                    document.location.href='http://localhost:8888/ASScw2/homepage/';
                    console.log('LOGIN SUCCESS' + response.toJSON().username);
                },
                error: function(err, args) {
                    swal ( "Warning" ,  "Check your credentials!" ,  "warning" );
                    console.log(err);
                    console.log(args);
                }
            })
    });
/*--------------------------------- USER REGISTER --------------------------------------------------------------*/

    var RegisterUser = Backbone.Model.extend({
        defaults:{
            username: '',
            password: '',
            name: '',
            description: ''
        }
    });

    var register = Backbone.Model.extend({
        url: 'http://localhost:8888/ASScw2/rest/register/'
    });


    $('.register').on('click',function () {

        if($('.username').val() == ''){
            swal ( "Warning" ,  "Username cannot be empty!" ,  "warning" );
        }else if($('.password').val() == ''){
            swal ( "Warning" ,  "Password cannot be empty!" ,  "warning" );
        }
        else if($('.name').val() == ''){
            swal ( "Warning" ,  "List Name cannot be empty!" ,  "warning" );
        }
        else if($('.description').val() == ''){
            swal ( "Warning" ,  "List Description cannot be empty!" ,  "warning" );
        }else{

            var registerInstance = new register();
            var details={
                username: $('.username').val(),
                password: $('.password').val(),
                name: $('.name').val(),
                description: $('.description').val()
            };
            registerInstance.save(details, {
                success: function(response){
                    //swal ( "success" ,  "Registered Successfully" ,  "success" );
                    console.log('REGISTER SUCCESSFUL' + response.toJSON().username);
                    document.location.href='http://localhost:8888/ASScw2/userLogin/';
                },
                error: function(){
                    swal ( "Warning" ,  "Unable to Create account!" ,  "warning" );
                    console.log('REGISTER FAILED');
                }
            })
        }
    });

});