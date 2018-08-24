using System;
using System.Collections.Generic;
using System.Threading;
using Microsoft.VisualStudio.TestTools.UnitTesting;
using OpenQA.Selenium;
using OpenQA.Selenium.Chrome;

namespace MovieReviewUnitTests
{
    [TestClass]
    public class TCLogin
    {
        int waitTime = 2000;
        [TestMethod]
        public void LoginTest()
        {
            IWebDriver session = new ChromeDriver
            {
                Url = "http://localhost:8080/moviereviewRepo/MovieReview/default.php"
            };

            Login(session, waitTime);

            if (!IsElementPresent(By.Id("welcomeLabel"), session))
                Assert.Fail("Login failed");

            session.Quit();
        }

        [TestMethod]
        public void TestUnLike()
        {
            IWebDriver session = new ChromeDriver
            {
                Url = "http://localhost:8080/moviereviewRepo/MovieReview/default.php"
            };

            Login(session, waitTime);
            TestDriverTutorial(session, waitTime);

            IList<IWebElement> unLikableButtons = GetUnLikableButtons(session);
            if (unLikableButtons != null)
            {
                for (int i = 0; i < unLikableButtons.Count; i++)
                {
                    unLikableButtons[i].SendKeys(Keys.Enter);
                }
            }

            session.Quit();
        }

        [TestMethod]
        public void TestLike()
        {
            IWebDriver session = new ChromeDriver
            {
                Url = "http://localhost:8080/moviereviewRepo/MovieReview/default.php"
            };

            Login(session, waitTime);
            TestDriverTutorial(session, waitTime);

            IList<IWebElement> likableButtons = GetLikableButtons(session);
            if (likableButtons != null)
            {
                for (int i = 0; i < likableButtons.Count; i++)
                {
                    likableButtons[i].SendKeys(Keys.Enter);
                }
            }
            Thread.Sleep(waitTime);

            session.Quit();
        }

        private bool Login(IWebDriver session, int waitTime)
        {
            IWebElement txtSearch = session.FindElement(By.Id("txtSearch"));
            IWebElement btnLogin = session.FindElement(By.Id("btnLogin"));
            IWebElement txtEmail = session.FindElement(By.Id("txtEmail"));
            IWebElement txtPassword = session.FindElement(By.Id("txtPassword"));
            IWebElement btnLoginSubmit = session.FindElement(By.Id("btnLoginSubmit"));

            btnLogin.Click();
            Thread.Sleep(waitTime);

            txtEmail.SendKeys("test33@test.com");
            txtPassword.SendKeys("11223344");

            btnLoginSubmit.Click();

            bool success = IsElementPresent(By.Id("welcomeLabel"), session);

            return success;
        }

        private bool TestDriverTutorial(IWebDriver session, int waitTime)
        {
            bool exists = IsElementPresent(By.ClassName("driver-close-btn"), session);

            if (exists)
            {
                IWebElement btnCloseDriver = session.FindElement(By.ClassName("driver-close-btn"));
                btnCloseDriver.Click();
            }

            return exists;
        }

        /// <summary>
        /// Searches the dom for the specified field and returns true or false
        /// </summary>
        /// <param name="by"></param>
        /// <param name="session"></param>
        /// <returns></returns>
        private bool IsElementPresent(By by, IWebDriver session)
        {
            try
            {
                session.FindElement(by);
                return true;
            }
            catch (NoSuchElementException)
            {
                return false;
            }
        }

        private IList<IWebElement> GetLikableButtons(IWebDriver session)
        {
            IList<IWebElement> likeButtons = session.FindElements(By.CssSelector("[class='btn btn-sm btn-outline-secondary waves-effect waves-light']"));
            return likeButtons;
        }

        private IList<IWebElement> GetUnLikableButtons(IWebDriver session)
        {
            IList<IWebElement> likeButtons = session.FindElements(By.CssSelector("[class='btn btn-sm btn-outline-success waves-effect waves-light']"));
            return likeButtons;
        }

        public void WaitForAjax(IWebDriver session)
        {
            while (true) // Handle timeout somewhere
            {
                var ajaxIsComplete = (bool)(session as IJavaScriptExecutor).ExecuteScript("return jQuery.active == 0");
                if (ajaxIsComplete)
                    break;
                Thread.Sleep(100);
            }
        }

    }
}
