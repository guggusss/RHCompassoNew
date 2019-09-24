function funcao() {
	document.getElementById("senhaUsuario").innerHTML = "Nova senha";
}

document.getElementById("senhaUsuario").addEventListener("click", function () {
	function hasUppercase(char) {
		var regex = new RegExp('[A-Z]');
		return regex.test(char);
	}

	function asciiLength(ascii) {
		return Math.floor(Math.random() * ascii.length);
	}

	function asciiChar(ascii, i) {
		return String.fromCharCode(Math.floor(Math.random() * (ascii[i][1] - ascii[i][0])) + ascii[i][0])
	}

	function generatorPassword(pw_height) {
		var pw_height_default = pw_height || 8;

		while (0 < 1) {
			var ascii = [
				[48, 57],
				[64, 90],
				[97, 122]
			];
			var ascii_special = [
				[33, 33],
				[35, 38],
				[42, 46]
			];
			var temp_ascii;
			var roll_dice = Math.floor(Math.random() * pw_height_default);
			var password = new String();
			var finish_repeat = false;
			for (let index = 0; index < pw_height_default; index++) {
				if (index === roll_dice) {
					temp_ascii = ascii_special;
				} else {
					temp_ascii = ascii;
				}
				var i = asciiLength(temp_ascii);
				var temp = asciiChar(temp_ascii, i);
				if (i == 0) {
					temp = temp.toUpperCase();
				}
				password += temp;
				finish_repeat = true;
			}
			if (finish_repeat) {
				break
			}
		}
		$('#senhaUsuario').click(function(){
			$('#jogaSenha').val(password);
		});
		return password;
	}
	generatorPassword();
});