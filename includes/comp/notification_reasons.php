<?php

if($reason == "referral_approved"){
	return $lang['notification']['approved_prposal'];
}
if($reason == "proposal_referral_approved"){
	return $lang['notification']['approved_referral_proposal'];
}

if($reason == "modification"){
	return $lang['notification']['modification'];
	}

if($reason == "declined"){
	return $lang['notification']['declined'];
}

if($reason == "approved"){
	return $lang['notification']['approved'];
}

if($reason == "unapproved_request"){
	return $lang['notification']['unapproved_request'];
}

if($reason == "approved_request"){
	return $lang['notification']['approved_request'];
}

if($reason == "offer"){
	return $lang['notification']['offer'];
}

if($reason == "order"){
	return $lang['notification']['order'];
}

if($reason == "order_tip"){
	return $lang['notification']['order_tip'];
}

if($reason == "order_message"){
	return $lang['notification']['order_message'];
}
//
if($reason == "order_revision"){
	return "Requested for a revision.";
}

if($reason == "order_completed"){
	return $lang['notification']['order_complete'];
}

if($reason == "order_delivered"){
	return "Delivered your order.";
}

if($reason == "cancellation_request"){
	return "Wants to cancel the order.";
}

if($reason == "decline_cancellation_request"){
	return "Declined your cancellation request.";
}

if($reason == "accept_cancellation_request"){
	return "Accepted cancellation request.";
}

if($reason == "cancelled_by_customer_support"){
	return "Order has been cancelled by admin.";
}

if($reason == "buyer_order_review"){
	return "Please review and rate your buyer.";
}
if($reason == "seller_order_review"){
	return "Please review and rate your seller.";
}

if($reason == "order_cancelled"){
	return "Your order has been cancelled.";
}

if($reason == "withdrawal_declined"){
	return "your withdrawal request has been declined. click here to view reason.";
}

if($reason == "withdrawal_approved"){
	return "your withdrawal request has been completed. click here to view.";
}

if($reason == "extendTimeDeclined"){
	return "Has Declined your extention.";
}

if($reason == "extendTimeAccepted"){
	return "Has accepted your extension. Time was increased successfully.";
}

if($reason == "buyerExtendTimeAccepted"){
	return "Time increased successfully.";
}

if($reason == "ticket_reply"){
	return "just responded to your ticket.";
}