<div class="row justify-content-center mt-2 mb-2">
	<div class="col-12 col-sm-12 formheader">
		<form class="form-inline" onsubmit="getdata(); return false;">
			<div class="form-group mx-sm-3 mb-2">
				<input type="text" class="form-control" id="txtsearch" placeholder="Enter your text">
			</div>
			<input type="submit" name="submit" class="btn btn-success mx-sm-1 mb-2 btn-search" value="Search">
			<button type="button" class="btn btn-primary mx-sm-1 mb-2 btn-add"><i class="fa fa-plus"> </i> Add Record</button>
			<button type="button" class="btn btn-info mx-sm-1 mb-2 btn-reset"><i class="fa fa-refresh"> </i> Reset</button>
		</form>
	</div>
</div>
<div class="row justify-content-center mt-2 mb-2 listrecord">
</div>



<script type="text/javascript">
	var _crud = "add";
	$(".formheader").hide();
	$(document).ready(function() {
		$("#txtsearch").val("");
		getdata();
		var rows = "";
		$(".btn-add").click(function() {
			_crud = "add";
			var get = $("#txtlink").val();
			$(".formheader").hide();
			getajax("get", "get.php", "get=form&module=" + get + "&key=", 0);
		});
		$(".btn-search").click(function() {
			getdata();
			return false;
		});
		$(".btn-reset").click(function() {
			$(".formheader").show();
			$("#txtsearch").val("");
			getdata();
			return false;
		});

	});

	function getdata() {
		var get = $("#txtlink").val();
		//alert(get)
		if (get === "alternatif") {
			$(".formheader").show();
			var key = $("#txtsearch").val();
			getajax("get", "get.php", "get=listrecord&module=" + get + "&key=" + key, 0);
		} else if (get === "kriteria") {
			var key = $("#txtsearch").val();
			getajax("get", "get.php", "get=listrecord&module=" + get + "&key=" + key, 0);
		} else if (get === "rangking") {
			$(".formheader").hide();
			getajax("get", "get.php", "get=" + get, 0);
		} else {
			$(".formheader").hide();
			getajax("get", "get.php", "get=" + get, 0);

		}

	}


	function getajax(_type, _url, _query, mng) {
		$(".listrecord").html("<p class='text-center text-dark'><img src='assets/img/loading.gif'><br>Loading..</p>");
		$.ajax({
			type: _type,
			url: _url,
			data: _query,
			dataType: 'JSON',
			cache: false,
			success: function(msg) {
				if (mng == 0) {
					$(".listrecord").html(msg);
				} else if (mng == 1) {
					getdata();
				} else {
					$(".moduletitle").html("FUZZY AHP PERANGKINGAN");
					getajax("get", "get.php", "get=fahp", 0);
				}
			}
		});
	}

	function fahpproses() {
		getajax("get", "get.php", "get=fahp", 0);
		return;
	}

	function _cancel() {
		$(".btn-reset").click();
	}

	function _submit(input) {
		var get = $("#txtlink").val();
		var str = "";
		var _input = input.split("_");
		var c = "0";
		for (var i = 0; i < _input.length; i++) {
			var v = $('#' + _input[i]).val();
			if (v == "") {
				c = "1";
			} else {
				str = str + "&" + _input[i] + "=" + v;
			}
		}

		if (c == "0") {
			var query = "get=crud&module=" + get + "&status=" + _crud + str;
			getajax("post", "get.php", query, 1);
		} else {
			alert("pastikan semua data di isi...!");
			return;
		}

	}

	function _remove(key, ind) {
		var del = confirm("Anda yakin ingin mengapus record ini..?");
		if (del == true) {
			_crud = "remove";
			var get = $("#txtlink").val();
			var query = "get=crud&module=" + get + "&status=" + _crud + "&" + ind + "=" + key;
			getajax("get", "get.php", query, 1);
		}
	}


	function _edit(key) {
		_crud = "edit";
		var get = $("#txtlink").val();
		$(".formheader").hide();
		getajax("get", "get.php", "get=form&module=" + get + "&key=" + key, 0);
	}

	function _post(d, x) {
		//alert("ok")
		$(".errorinput").hide();
		var str = d.split("MB");
		var o = 0;
		var s = "0";
		var _input_ = "";
		var _status = "";
		for (var r = 0; r < str.length; r++) {
			var k = str[r].split("_");
			for (var i = 0; i < k.length; i++) {
				_input_ = _input_ + k[i] + "__";
				for (var l = 0; l <= x; l++) {
					var m = $("#X_" + k[i] + "_" + l).val();
					if (m == "") {
						s = "1";
					}
					_input_ = _input_ + m + "X";
				}
				_input_ = _input_ + "XXX";
			}
			_input_ = _input_ + "LFC";
		}

		if (s == "0") {
			var query = "get=nilai&strnilai=" + _input_;
			//getajax("post", "get.php", query, 2);
			getajax("get","get.php","get=fahp",0);

		} else {
			$(".errorinput").show();
			$(".errorinput").html("<p class='text-danger bg-light border border-danger'>WARNING..!!! <br>Pastikan inputan data perbandingan lebih besar dari nol</p>");
			return;
		}
	}
</script>