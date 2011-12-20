(function(window) {
	function namespace(str, func /*function*/) {
		var arr = str.split("."), parent = window, n = arr.length, i = 0, nextName = "";

		for(i; i < n; i++) {
			nextName = arr[i];
			if( typeof (parent[nextName]) === "undefined") {
				parent[nextName] = {};
			}

			if(i === n - 1 && typeof (func) === "function") {
				parent[nextName] = func();
			}
			parent = parent[arr[i]];
		}
	}

	// exporting it
	window.namespace = namespace;
})(window);

namespace("FMI.Feedback", function() {
	var _private = {
	};

	return {
		basePath : "ajax/gateway.php",
		Util : {
			appendToCombo : function(componentId/*string*/, data/*object*/, valueKey/*string*/, textKey/*string*/) {
				var cnt = 0;
				if( typeof (componentId) !== "string" || typeof (data) !== "object" || typeof (valueKey) !== "string" || typeof (textKey) !== "string") {
					return false;
				}

				$("#{0}".format(componentId)).find("option").remove();
				for(var i in data["data"]) {
					cnt++;
					$("#{0}".format(componentId)).append('<option value="{0}">{1}</option>'.format(data['data'][i][valueKey], data['data'][i][textKey])).trigger('change');
				}
				return cnt;
			}
		},
		ajaxSuggestRespNamesOnly : [],
		ajaxSuggestRespSuggests : {},
		ajaxSuggestResp : []
	}
});
