using System;
using System.Collections;
using System.Collections.Generic;
using System.Text;
namespace Admintemplate
{
    #region Products
    public class Products
    {
        #region Member Variables
        protected int _id;
        protected string _product_serial;
        protected string _product_name;
        protected string _product_brief;
        protected unknown _product_detail;
        protected string _cover_image;
        protected string _price;
        protected string _manufacturer;
        protected bool _special;
        protected unknown _selloff;
        protected string _author;
        protected int _order;
        protected bool _publish;
        protected int _lock_status;
        protected int _created_id;
        protected DateTime _created_time;
        protected int _last_modified_id;
        protected DateTime _last_modified_time;
        protected int _publisher_id;
        protected DateTime _publish_time;
        protected int _product_category_id;
        protected unknown _product_assessment;
        protected unknown _product_guarantee;
        protected string _product_model;
        protected string _product_code;
        protected unknown _product_guarantee_policy;
        protected string _product_price_new;
        protected int _view_counter;
        #endregion
        #region Constructors
        public Products() { }
        public Products(string product_serial, string product_name, string product_brief, unknown product_detail, string cover_image, string price, string manufacturer, bool special, unknown selloff, string author, int order, bool publish, int lock_status, int created_id, DateTime created_time, int last_modified_id, DateTime last_modified_time, int publisher_id, DateTime publish_time, int product_category_id, unknown product_assessment, unknown product_guarantee, string product_model, string product_code, unknown product_guarantee_policy, string product_price_new, int view_counter)
        {
            this._product_serial=product_serial;
            this._product_name=product_name;
            this._product_brief=product_brief;
            this._product_detail=product_detail;
            this._cover_image=cover_image;
            this._price=price;
            this._manufacturer=manufacturer;
            this._special=special;
            this._selloff=selloff;
            this._author=author;
            this._order=order;
            this._publish=publish;
            this._lock_status=lock_status;
            this._created_id=created_id;
            this._created_time=created_time;
            this._last_modified_id=last_modified_id;
            this._last_modified_time=last_modified_time;
            this._publisher_id=publisher_id;
            this._publish_time=publish_time;
            this._product_category_id=product_category_id;
            this._product_assessment=product_assessment;
            this._product_guarantee=product_guarantee;
            this._product_model=product_model;
            this._product_code=product_code;
            this._product_guarantee_policy=product_guarantee_policy;
            this._product_price_new=product_price_new;
            this._view_counter=view_counter;
        }
        #endregion
        #region Public Properties
        public virtual int Id
        {
            get {return _id;}
            set {_id=value;}
        }
        public virtual string Product_serial
        {
            get {return _product_serial;}
            set {_product_serial=value;}
        }
        public virtual string Product_name
        {
            get {return _product_name;}
            set {_product_name=value;}
        }
        public virtual string Product_brief
        {
            get {return _product_brief;}
            set {_product_brief=value;}
        }
        public virtual unknown Product_detail
        {
            get {return _product_detail;}
            set {_product_detail=value;}
        }
        public virtual string Cover_image
        {
            get {return _cover_image;}
            set {_cover_image=value;}
        }
        public virtual string Price
        {
            get {return _price;}
            set {_price=value;}
        }
        public virtual string Manufacturer
        {
            get {return _manufacturer;}
            set {_manufacturer=value;}
        }
        public virtual bool Special
        {
            get {return _special;}
            set {_special=value;}
        }
        public virtual unknown Selloff
        {
            get {return _selloff;}
            set {_selloff=value;}
        }
        public virtual string Author
        {
            get {return _author;}
            set {_author=value;}
        }
        public virtual int Order
        {
            get {return _order;}
            set {_order=value;}
        }
        public virtual bool Publish
        {
            get {return _publish;}
            set {_publish=value;}
        }
        public virtual int Lock_status
        {
            get {return _lock_status;}
            set {_lock_status=value;}
        }
        public virtual int Created_id
        {
            get {return _created_id;}
            set {_created_id=value;}
        }
        public virtual DateTime Created_time
        {
            get {return _created_time;}
            set {_created_time=value;}
        }
        public virtual int Last_modified_id
        {
            get {return _last_modified_id;}
            set {_last_modified_id=value;}
        }
        public virtual DateTime Last_modified_time
        {
            get {return _last_modified_time;}
            set {_last_modified_time=value;}
        }
        public virtual int Publisher_id
        {
            get {return _publisher_id;}
            set {_publisher_id=value;}
        }
        public virtual DateTime Publish_time
        {
            get {return _publish_time;}
            set {_publish_time=value;}
        }
        public virtual int Product_category_id
        {
            get {return _product_category_id;}
            set {_product_category_id=value;}
        }
        public virtual unknown Product_assessment
        {
            get {return _product_assessment;}
            set {_product_assessment=value;}
        }
        public virtual unknown Product_guarantee
        {
            get {return _product_guarantee;}
            set {_product_guarantee=value;}
        }
        public virtual string Product_model
        {
            get {return _product_model;}
            set {_product_model=value;}
        }
        public virtual string Product_code
        {
            get {return _product_code;}
            set {_product_code=value;}
        }
        public virtual unknown Product_guarantee_policy
        {
            get {return _product_guarantee_policy;}
            set {_product_guarantee_policy=value;}
        }
        public virtual string Product_price_new
        {
            get {return _product_price_new;}
            set {_product_price_new=value;}
        }
        public virtual int View_counter
        {
            get {return _view_counter;}
            set {_view_counter=value;}
        }
        #endregion
    }
    #endregion
}