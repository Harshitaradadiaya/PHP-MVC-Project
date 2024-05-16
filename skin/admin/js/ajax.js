var Ajax = {
    url : null,
    method : 'POST',
    params : null,
    dataType : 'json',
    data : {},
    form : null,
    setUrl : function(url) {
        this.url = url;
        // alert(url);
        return this;
    },
    getUrl : function() {
        return this.url;
    },
    setMethod : function(method) {
        this.method = method;
        return this;
    },
    getMethod : function() {
        return this.method;
    },
    setParams : function(params) {
        this.params = params;
        return this;
    },
    getParams : function() {
        return this.params;
    },
    setData : function(data) {
        console.log(data);
        return this.data = data;
    },
    getData : function() {
        return this.data;
    },
    setDataType : function (dataType) {
        this.dataType = dataType;
        return this;
    },
    getDataType : function () {
        return this.dataType;
    },
    setForm : function(form) {
        this.form = form;
        return this;
    },
    getForm : function () {
        return this.form;
    },
    manageHtml : function(data) {
        if (typeof(data) !== 'object') {
            return false;
        }
        if (typeof(data.elements) !== 'object') {
            return false;
        }
        data.elements.forEach(function(element){
            if(typeof(element.identifier) === 'string') {
                jQuery('#'+ element.identifier).html(element.html);
            }
        });
    },
    load : function () {
        console.log(this.getDataType());
        console.log(this.getMethod());
        jQuery.ajax({
            url : this.getUrl(),
            method : this.getMethod(),
            data : this.getData(),
            dataType : this.getDataType(),
            success : function(data) {
                console.log('call');
                Ajax.manageHtml(data);
            }
        });
    },
    saveForm : function(form) {
        id = this.getForm();
        data = jQuery('#'+id).serialize();
        this.setData(data);
        this.load();
    }

}