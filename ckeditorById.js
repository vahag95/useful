	var instance = CKEDITOR.instances[id];
    if(instance){
        instance.destroy(instance);
    }
    CKEDITOR.replace( id );