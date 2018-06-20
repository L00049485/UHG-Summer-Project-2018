namespace MovieReviewNew.API.Controllers
{
    using System;
    using System.Collections.Generic;
    using System.Linq;
    using System.Net;
    using System.Web.Http;
    using MovieReviewNew.API.Models;
    using Newtonsoft.Json;

    [RoutePrefix("api/Data")]
    public class DefaultController : ApiController
    {
        [HttpPost]
        [Route("TestStp")]
        public IHttpActionResult TestStp()
        {
            List<spTest_Result> results = null;
            try
            {
                using (EFTestdbEntities dbContext = new EFTestdbEntities())
                {
                    results = new List<spTest_Result>();
                    results = dbContext.spTest().ToList();
                }

                return Ok(JsonConvert.SerializeObject(results, Formatting.Indented));
            }
            catch (Exception ex)
            {
                return Content(HttpStatusCode.BadRequest, ex.Message);
            }
        }
    }
}
