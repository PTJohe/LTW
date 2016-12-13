//ESTE FICCHEIRO NAO TA A SER INCLUIDO, PORQUE É COMPLICADO FAZELO EM JAVASCRIPT
//ESTE CODIGO FOI COPIADO/COLADO NO editRestaurantInfo.js

function validateTitle(title)
{
	//Doesn't recognize < (essential to pass scripts) and other simbols
	return /[\w \sáàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ+-]+/.test(title);
}

function validatePhoneNumber(number)
{
	//Only recgnizes numbers
	return /(\+\d{3})?(\d{3}([-, ]?)){2}(\d{3})\b/.test(number);
}

function validateAddress(address)
{
	//Doesn't recognize < (essential to pass scripts) and other simbols
	return /[\w \sáàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ+-]+/.test(address);
}

function validateDescription(description)
{
	//Doesn't recognize < (essential to pass scripts) and other simbols
	return /[\w \sáàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ+-]+/.test(description);
}
