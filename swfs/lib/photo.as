package lib{
	public class photo {
		public var _title:String;
		public var _description:String;
		public var _summary:String;
		public var _image:String;
		public var _thumbnail:String;
		public var _width:Number;
		public var _height:Number;

		public var _fstop:Number;
		public var _make:String;
		public var _model:String;
		public var _exposure:Number;
		public var _flash:Boolean;
		public var _focal:Number;
		public var _iso:Number;
		public var _time:Date;

		public var _link:String;


		public function photo(photoXML:XML) {
			this._link = photoXML.children()[8].attribute("href");

			var mediaXMLNS:Namespace = photoXML.namespace('media');
			var mediaXMLList:XMLList = photoXML.mediaXMLNS::group;
			for each (var mediaInfo:XML in mediaXMLList) {
				getMedia(mediaInfo);
			}
			var exifXMLNS:Namespace = photoXML.namespace('exif');
			var exifXMLList:XMLList = photoXML.exifXMLNS::tags;
			for each (var exifInfo:XML in exifXMLList) {
				getExif(exifInfo);
			}
		}
		function getExif(exifXML:XML) {
			var exifXMLNS:Namespace = exifXML.namespace('exif');
			this._fstop = exifXML.exifXMLNS::fstop;
			this._make = exifXML.exifXMLNS::make;
			this._model = exifXML.exifXMLNS::model;
			this._exposure = exifXML.exifXMLNS::exposure;
			this._flash = exifXML.exifXMLNS::flash;
			this._iso = exifXML.exifXMLNS::iso;
			this._time = new Date(exifXML.exifXMLNS::time);
		}
		function getMedia(mediaXML:XML) {
			var mediaXMLNS:Namespace = mediaXML.namespace('media');
			this._title = mediaXML.mediaXMLNS::title;
			this._description = mediaXML.mediaXMLNS::description;
			this._image = mediaXML.mediaXMLNS::content.attribute('url');
			this._width = mediaXML.mediaXMLNS::content.attribute('width');
			this._height = mediaXML.mediaXMLNS::content.attribute('height');
			var thumb64:String = mediaXML.mediaXMLNS::thumbnail[0].attribute('url');
			var myPattern:RegExp = /s72/;
			this._thumbnail = thumb64.replace(myPattern, "s64");
		}
		public function getEXIFInfo():String {
			var monthLabels:Array = new Array("January",
			                  "February",
			                  "March",
			                  "April",
			                  "May",
			                  "June",
			                  "July",
			                  "August",
			                  "September",
			                  "October",
			                  "November",
			                  "December");
			var strInfo:String='';
			/*strInfo+= "Camera:"+this._make+", "+this._model;
			strInfo+= ", Fstop: "+this._fstop;
			strInfo+= ", Exposure: "+this._exposure;
			strInfo+= ", Flash: "+this._flash;
			strInfo+= ", ISO: "+this._iso;
			strInfo+= ", Clicked On: "+this._time;*/
			strInfo+= this._time.getDate() +' '+ monthLabels[this._time.getMonth()] +' '+ this._time.getFullYear();
			return strInfo;
		}
		public function displayInfo():String {
			var strInfo:String='';
			strInfo='<b>TITLE:</b> ' + this._title;
			strInfo+= '\n<b>DESCRIPTION:</b> ' + this._description;
			strInfo+= '\n<b>PHOTO TAKEN:</b> ' + this.getEXIFInfo();
			strInfo+= '\n<b>PHOTO LINK:</b> <a href="'+this._link+'">Click <u>'+this._title+'</a>';
			return strInfo;
		}
	}
}