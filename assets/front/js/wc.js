(function(w) {
	var wc = {
		/**
		 * 检查参数是否为空
		 * @param val
		 * @returns {boolean}
		 */
		isEmpty : function(val) {
			switch (typeof(val)) {
			case "string":
				return this.trim(val).length == 0 ? true : false;
			case "number":
				return val == 0;
			case "object":
				return val == null;
			case "array":
				return val.length == 0;
			default:
				return true;
			}
		},
		trim: function(s) {
            return s.replace(/(^\s*)|(\s*$)/g, "");
        }
	};

	w.wc = wc;
})(window);
