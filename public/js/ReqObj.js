var ReqObj=null;
function initReqObj()
{
	if(ReqObj==null)
	{
		ReqObj=new JsHttpRequest();
	}
	
	return true;
}